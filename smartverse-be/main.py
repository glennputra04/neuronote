from fastapi import FastAPI, UploadFile, File
import numpy as np
from transformers import pipeline
import shutil
import os
import re
from PIL import Image
import io
import subprocess
import fitz  
from rapidocr_onnxruntime import RapidOCR
from collections import Counter
import re

app = FastAPI()
ocr = RapidOCR()

summarizer = pipeline(
    "summarization",
    model="facebook/bart-large-cnn"
)

def extract_all_text(pdf_path):
    doc = fitz.open(pdf_path)
    slides = []

    for page_num in range(len(doc)):
        page = doc.load_page(page_num)
        
        # native texts
        page_text = page.get_text().strip()
        
        image_text = ""
        
        # process images
        if len(page_text) < 50:
            image_list = page.get_images(full=True)
            ocr_count = 0
            max_ocr_per_page = 2 

            for img in image_list:
                if ocr_count >= max_ocr_per_page:
                    break

                xref = img[0]
                base_image = doc.extract_image(xref)
                
                # Ignore icons
                if base_image["width"] < 400 or base_image["height"] < 400:
                    continue

                image_bytes = base_image["image"]
                image = Image.open(io.BytesIO(image_bytes)).convert("RGB")

                result, _ = ocr(np.array(image)) 

                if result:
                    detected_text = " ".join([line[1] for line in result])
                    image_text += detected_text + " "
                
                ocr_count += 1

        full_content = (page_text + " " + image_text).strip()

        slides.append({
            "slide_number": page_num + 1,
            "content": full_content
        })

    doc.close()
    return slides


def clean_text(text):

    text = re.sub(r'http\S+', '', text)
    text = re.sub(r'\S+@\S+', '', text)

    # Handle Bullet Point
    text = re.sub(r'\n\s*[\d\.\-\*\•>]+\s*', '. ', text)

    # Normalize Dash & Weird Characters
    text = text.replace(" - ", ". ")
    text = re.sub(r'[^A-Za-z0-9.,()\-:;!?\n ]+', ' ', text)

    # Fix Punctuation
    text = re.sub(r'\.\s*\.', '.', text)
    
    # Normalize Spacing 
    text = re.sub(r'[ \t]+', ' ', text) 
    text = text.replace('\n', ' ')    
    text = re.sub(r'\s+', ' ', text)   
    
    return text.strip()




def is_closing_slide(text):

    text_lower = text.lower()

    keywords = [
        "thank you",
        "thanks",
        "terima kasih",
        "questions",
        "q&a",
        "any questions"
    ]

    for k in keywords:
        if k in text_lower:
            return True

    return False

def is_reference_slide(text):

    text_lower = text.lower()

    # banyak ISBN
    if text_lower.count("isbn") >= 3:
        return True

    return False



def filter_irrelevant_slides(slides):

    total = len(slides)

    filtered = []

    for i, slide in enumerate(slides):

        text = slide["content"]

        if i == 0 : continue

        # cek 3 halaman terakhir
        if i >= total - 3:
            if is_reference_slide(text) or is_closing_slide(text):
                continue

        filtered.append(slide)

    return filtered

def group_short_slides(slides, min_words=120):
    grouped_slides = []
    buffer_text = ""
    buffer_numbers = []

    for slide in slides:
        content = clean_text(slide["content"])
        print(content);
        word_count = len(content.split())

        if word_count == 0:
            continue

        buffer_text += " " + content
        buffer_numbers.append(slide["slide_number"])

        if len(buffer_text.split()) >= min_words:
            grouped_slides.append({
                "slide_numbers": buffer_numbers.copy(),
                "content": buffer_text.strip()
            })
            buffer_text = ""
            buffer_numbers = []

    # Sisa terakhir
    if buffer_text:
        grouped_slides.append({
            "slide_numbers": buffer_numbers,
            "content": buffer_text.strip()
        })

    return grouped_slides

def convert_ppt_to_pdf(input_path):
    output_dir = os.path.dirname(input_path)

    subprocess.run([
        "soffice",
        "--headless",
        "--convert-to",
        "pdf",
        input_path,
        "--outdir",
        output_dir
    ], check=True)


def summarize_per_slide(slides):
    slide_summaries = []

    for slide in slides:
        content = clean_text(slide["content"])

        topic = get_general_topic(content)

        try:
            result = summarizer(
                content,
                max_length=180,
                min_length=60,
                num_beams=4,
                batch_size=4,
                early_stopping=True,
            )

            summary_text = result[0]["summary_text"]

        except Exception as e:
            summary_text = f"Error summarizing slides {slide['slide_numbers']}: {str(e)}"

        slide_summaries.append({
            "topic" : topic,
            "slide_numbers": slide["slide_numbers"],
            "summary": summary_text
        })

    return slide_summaries

def get_general_topic(text):
    # 1. Bersihkan teks tapi tetap pertahankan case asli untuk pengecekan
    clean = re.sub(r'[^a-zA-Z\s]', '', text)
    words = clean.split()
    
    if not words:
        return "General Discussion"

    # Dictionary untuk menyimpan skor setiap kata
    word_scores = Counter()

    # Ambil 5 kata pertama untuk diberikan bonus "Position"
    first_few_words = [w.upper() for w in words[:5]]

    for i, word in enumerate(words):
        if len(word) <= 3:
            continue
            
        word_upper = word.upper()
        
        # --- SISTEM SKORING ---
        score = 1  # Skor dasar
        
        # A. Bonus jika ALL CAPS (biasanya judul atau singkatan penting)
        if word.isupper() and len(word) > 1:
            score += 2
            
        # B. Bonus jika muncul di awal slide (kandidat kuat judul)
        if word_upper in first_few_words:
            score += 3
            
        # C. Bonus jika diawali huruf kapital (Proper Noun / Title Case)
        elif word[0].isupper():
            score += 1

        word_scores[word.capitalize()] += score

    # Ambil 2 teratas berdasarkan skor total
    most_common = word_scores.most_common(2)
    
    if most_common:
        # Jika skor kata pertama jauh lebih tinggi, ambil satu saja agar lebih fokus
        if len(most_common) > 1 and most_common[0][1] > most_common[1][1] * 2:
            return most_common[0][0]
            
        topic = " & ".join([word for word, score in most_common])
        return topic

    return "Untitled Topic"

@app.post("/summarize")
async def summarize_ppt(file: UploadFile = File(...)):

    print("1. Upload received")

    os.makedirs("temp", exist_ok=True)

    file_location = os.path.abspath(f"temp/{file.filename}")

    with open(file_location, "wb") as buffer:
        shutil.copyfileobj(file.file, buffer)

    print("2. File saved:", file_location)

    print("3. Converting PPT to PDF...")
    convert_ppt_to_pdf(file_location)

    pdf_path = os.path.splitext(file_location)[0] + ".pdf"
    print("4. PDF created:", pdf_path)

    print("5. Extracting text from PDF...")
    slides = extract_all_text(pdf_path)

    print(slides)

    print("Slides extracted:", len(slides))

    print("6. Filtering irrelevant slides...")
    slides = filter_irrelevant_slides(slides)
    print("Slides after filtering:", len(slides))

    print("7. Grouping slides...")
    slides = group_short_slides(slides)

    print("Grouped slides:", len(slides))

    print("8. Summarizing slides...")
    slide_summaries = summarize_per_slide(slides)

    print("9. Done summarizing")

    return {
        "total_slides": len(slide_summaries),
        "slides_summary": slide_summaries
    }