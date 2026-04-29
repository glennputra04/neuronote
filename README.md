# NeuroNote Application

FastAPI-based backend service with laravel frontend that extracts text from PowerPoint (.pptx) files and generates AI-based summaries using HuggingFace Transformers.

## Objectives
- Help users quickly understand material without going through full PPTs or videos
- Convert lengthy content into clear, concise and essential summaries
- Save time and improve learning efficiency
- Highlight key points for review or exam/presentation preparation
- Support self-learning with more accessible and practical information
- Ensures users able to use the website's service as much as they want with free of charge.

---

## Features

- Upload PPTX / PPT / PDF file
- Extract text automatically
- Generate summary using Transformer model

---

## Tech Stack

- Transformers
- Fastapi
- Uvicorn
- Numpy
- Pillow
- Pymupdf
- Rapidocr-onnxruntime
- Torch

---

## Project Structure

- Frontend folder: smartverse-fe
- Backend folder: smartverse-be

---

## Installation

### Clone repository

```bash
git clone <your-repo-url>
cd smartverse-be
```

### Create Virtual Environment

```bash
python -m venv venv
```

### Activate Virtual Environment

Windows:

```bash
venv\Scripts\activate
```

Mac/Linux:

```bash
source venv/bin/activate
```

### Install Dependencies

```bash
pip install -r requirements.txt
```

---

## Run the Server

```bash
python -m uvicorn main:app --reload --port 8001
```

Open:

```
http://127.0.0.1:8001/docs
```

---

## API Endpoint

### POST /summarize

Upload a `.pptx / .ppt / .pdf` file.

Response:

```json
{
  "topic": "Title Learning Objectives For Unix Process Management System...",
  "slide_numbers": [
      1,2,3,...
      ],
  "summary": "The text provides information about the different types of processes..."
}
```

## Notes

- First run will download model
- Ensure internet connection available on first start
- Website prototype design: https://www.figma.com/design/St735PxlLhMC1lVU5sT2fk/NeuroNote?node-id=1-6622&t=0nARk4u90RGhk4Vc-0

---

## Usage

1. User uploads a PPTX / PPT / PDF file and then wait for it to be read and analyzed.
2. The website then generates a PDF file with summarized content of the uploaded file.
3. User is able to toggle summary type (bullet for concise summary, paragraph for long and detailed summary)
4. User is then able to download the summary file with PDF format.
5. The summary file will then be moved to history section for user to revisit.

---

## Author

Glenn Putra Laymando
Sofware Engineer

Antonio Owen Putra Amadeus
Software Engineer

Theo Filus Iglesias Triadi
Software Engineer

Justin Sufrapto
Software Engineer

...
