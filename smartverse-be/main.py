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
from fastapi import BackgroundTasks
import torch
from fastapi.middleware.cors import CORSMiddleware

app = FastAPI()

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"], 
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)
ocr = RapidOCR()

summarizer = pipeline(
    "summarization",
    model="MBZUAI/LaMini-Flan-T5-248M",
    device=-1 # 0 for GPU amd -1 for CPU
)

# summarizer.model = torch.quantization.quantize_dynamic(
#     summarizer.model, {torch.nn.Linear}, dtype=torch.qint8
# )

# ==================================== PPT SUMMARIZER =========================================
#region PPT SUMMARIZER
def remove_temp_files(paths: list):
    for path in paths:
        try:
            if os.path.exists(path):
                os.remove(path)
        except Exception as e:
            print(f"Cleanup error: {e}")


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
    text = " ".join(text.split())

    text = re.sub(r'http\S+', '', text)
    text = re.sub(r'\S+@\S+', '', text)

    # Handle Rights Reserved
    text = re.sub(r'\d{4}[\s\S]{0,70}?All\s+rights\s+reserved\.?', '', text, flags=re.IGNORECASE)
    text = re.sub(r'(Adapted from|Source):?.*', '', text, flags=re.IGNORECASE)

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
    if not slides:
        return []

    all_contents = [clean_text(s["content"]) for s in slides]
    all_topics = [generate_title_via_ai(c) for c in all_contents]
    
    prompts = [
    f"Act as a student making study notes. Summarize the actual facts and definitions from this text in a short paragraph. "
    f"Be direct and do not meta-describe the text: {c}" 
    for c in all_contents
]

    print(f"--- Processing {len(slides)} batches ---")

    try:
        # Batch Processing
        results = summarizer(
            prompts,
            max_length=150,
            min_length=40,
            num_beams=1,       
            batch_size=4,      
            truncation=True
        )

        slide_summaries = []
        for i, res in enumerate(results):
            slide_summaries.append({
                "topic": all_topics[i],
                "slide_numbers": slides[i]["slide_numbers"],
                "summary": res["summary_text"]
            })
            
        return slide_summaries

    except Exception as e:
        print(f"Error summarizing: {str(e)}")
        return []
    
def generate_title_via_ai(text):
    if not text.strip():
        return "Untitled Topic"
    
    prompt = f"Generate a short title (max 3 words) for this text: {text}"
    
    try:
        result = summarizer(
            prompt,
            max_length=15,
            min_length=3,
            truncation=True
        )

        title = result[0]["summary_text"].strip()
        title = re.sub(r'[^a-zA-Z0-9\s]', '', title)
        return title.title() 
    except Exception as e:
        print(f"Error generating title: {e}")
        return "General Topic"

def get_general_topic(text):
    clean = re.sub(r'[^a-zA-Z\s]', '', text)
    words = clean.split()
    
    if not words:
        return "General Discussion"

    word_scores = Counter()

    first_few_words = [w.upper() for w in words[:5]]

    for i, word in enumerate(words):
        if len(word) <= 3:
            continue
            
        word_upper = word.upper()
        
        score = 1  

        if word.isupper() and len(word) > 1:
            score += 2
            
        if word_upper in first_few_words:
            score += 3
            
        elif word[0].isupper():
            score += 1

        word_scores[word.capitalize()] += score

    most_common = word_scores.most_common(2)
    
    if most_common:
        if len(most_common) > 1 and most_common[0][1] > most_common[1][1] * 2:
            return most_common[0][0]
            
        topic = " & ".join([word for word, score in most_common])
        return topic

    return "Untitled Topic"

@app.post("/summarize")
async def summarize_ppt(background_tasks: BackgroundTasks, file: UploadFile = File(...)):

    print("1. Upload received")
    os.makedirs("temp", exist_ok=True)

    file_location = os.path.abspath(f"temp/{file.filename}")
    with open(file_location, "wb") as buffer:
        shutil.copyfileobj(file.file, buffer)

    print("2. File saved:", file_location)

    if file.filename.lower().endswith(".pdf"):
        print("3. File is already PDF, skipping conversion.")
        pdf_path = file_location
       
        files_to_cleanup = [file_location]
    else:
        print("3. Converting PPT/PPTX to PDF...")
        convert_ppt_to_pdf(file_location)
        pdf_path = os.path.splitext(file_location)[0] + ".pdf"
       
        files_to_cleanup = [file_location, pdf_path]

    print("4. Target PDF path:", pdf_path)

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

    background_tasks.add_task(remove_temp_files, files_to_cleanup)

    return {
        "total_slides": len(slide_summaries),
        "slides_summary": slide_summaries
    }
# ==================================== VIDEO SUMMARIZER =========================================
#region VIDEO SUMMARIZER

from faster_whisper import WhisperModel
from moviepy import VideoFileClip

# Load Model
stt_model = WhisperModel("tiny", device="cpu", compute_type="int8")

def extract_audio(video_path, audio_path):
    video = VideoFileClip(video_path)
    video.audio.write_audiofile(audio_path, logger=None,fps=16000, bitrate="64k")
    video.close()

def transcribe_audio(audio_path):
    segments, _ = stt_model.transcribe(audio_path)

    return [
        {"start": seg.start, "end": seg.end, "text": seg.text}
        for seg in segments
    ]

# Chunking every 3 min
def group_segments_by_time(segments, chunk_duration=180):

    if not segments:
        return {"error": "No speech detected"}
    chunks = []
    current_chunk = []
    chunk_start = segments[0]["start"]

    for seg in segments:
        if seg["end"] - chunk_start <= chunk_duration:
            current_chunk.append(seg)
        else:
            chunks.append(current_chunk)
            current_chunk = [seg]
            chunk_start = seg["start"]

    if current_chunk:
        chunks.append(current_chunk)

    return chunks


def build_text(chunk):
    return " ".join([seg["text"] for seg in chunk])


@app.post("/summarize-video")
async def summarize_video(background_tasks: BackgroundTasks, file: UploadFile = File(...)):
    print("1. Video upload received")
    os.makedirs("temp", exist_ok=True)
    
    video_location = f"temp/{file.filename}"
    audio_location = f"temp/{os.path.splitext(file.filename)[0]}.mp3"
    
    with open(video_location, "wb") as buffer:
        shutil.copyfileobj(file.file, buffer)

    try:
        print("2. Extracting audio...")
        extract_audio(video_location, audio_location)

        print("3. Transcribing audio (STT)...")
        segments = transcribe_audio(audio_location)

        print("4. Grouping audio Segments...")
        chunks = group_segments_by_time(segments)

        print("5. Summarizing...")
        results = []
        
        for i, chunk in enumerate(chunks):
            print(f"Segment : {i}")
            text = build_text(chunk)

            if not text.strip():
                continue

            # batasi panjang biar gak ke-truncate model
            words = text.split()
            if len(words) > 400:
                text = " ".join(words[:400])

            prompt = (
                f"Act as a student making study notes. Summarize the actual facts and definitions from this text in a short paragraph. " + \
                f"Be direct and do not meta-describe the text: {text}"
            )

            summary_result = summarizer(
                prompt,
                max_length=150,
                min_length=40,
                truncation=True
            )

            topic = get_general_topic(text)

            results.append({
                "topic": topic,
                "chunk_numbers": i + 1,
                "summary": summary_result[0]["summary_text"]
            })

        # Cleanup files
        background_tasks.add_task(remove_temp_files, [video_location, audio_location])

        return {
            "total_slides": len(results),
            "slides_summary": [
                {
                    "topic": r["topic"],
                    "slide_numbers": [r["chunk_numbers"]],
                    "summary": r["summary"]
                }
                for r in results
            ]
        }

    except Exception as e:
        print(f"Error: {e}")
        return {"error": str(e)}