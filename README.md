# PPT Summarizer API

FastAPI-based backend service that extracts text from PowerPoint (.pptx) files and generates AI-based summaries using HuggingFace Transformers.

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

## Installation

### 1️Clone repository

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

---

## Author

Glenn Putra Laymando
Antonio Owen Putra Amadeus
Software Engineer

...
