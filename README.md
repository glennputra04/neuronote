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
- Swagger API documentation

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
