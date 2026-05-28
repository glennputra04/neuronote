@extends('layouts.app')
@section('title', 'Summary - NeuroNote')
@push('styles')
    <style>
        body {
            background: #f3f4f6;
        }

        .file-box {
            border: 2px dashed #444;
            border-radius: 12px;
            padding: 14px 18px;
            background: white;
        }

        .file-inner {
            border: 2px solid #222;
            border-radius: 10px;
            padding: 14px;
        }

        .summary-card {
            background: white;
            border-radius: 14px;
            border: 3px solid #3b82f6;
            padding: 28px;
            box-shadow: 0 10px 18px rgba(0, 0, 0, 0.08);
        }

        .mode-btn {
            border: 1px solid #999;
            padding: 10px 18px;
            background: #f9fafb;
            transition: 0.2s;
        }

        .mode-btn img {
            height: 22px;
        }

        .mode-btn img,
        .download-btn img {
            display: block;
        }

        .scroll-icon img {
            display: block;
        }


        .mode-btn.active {
            background: white;
            border: 2px solid #222;
        }

        .generate-btn {
            background: white;
            color: #3b82f6;
            padding: 10px 18px;
            border-radius: 10px;
            border: 2px solid #3b82f6;
            font-weight: 600;
            transition: 0.2s;
        }

        .generate-btn img {
            height: 22px;
            display: block;
        }

        .generate-btn:hover {
            background: #eff6ff;
        }

        .download-btn {
            background: #3b82f6;
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            border: none;
        }

        .download-btn img {
            height: 22px;
        }

        .download-btn:hover {
            background: #2563eb;
        }

        .scroll-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
        }

        .scroll-icon img {
            height: 35px;
        }

        .cancel img {
            height: 35px;
        }

        .how-card {
            background: #cfe0f7;
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
        }

        .step-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #3d7fe0;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: auto;
        }

        .card-shadow {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 12px;
        }


        .icon-box {
            width: 70px;
            height: 70px;
            background: #cfe0f7;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .why-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.10);
            text-align: left;
            min-height: 230px;
        }
    </style>
@endpush
@section('content')
    <section id="summary" class="py-4">
        <div class="container">

            <a href="/" class="text-decoration-none text-secondary fw-semibold">
                <img src="{{ asset('images/back.png') }}" width="18">
                Back to Home
            </a>

            <div class="file-box mt-4">
                <div class="file-inner d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center">
                        <img id="file-icon"
                            src="{{ asset('images/' . (pathinfo($summary->file_name ?? '', PATHINFO_EXTENSION) === 'mp4' ? 'mp4.png' : 'ppt.png')) }}"
                            width="40" class="me-3">
                        <strong id="file-name">{{ $summary->file_name ?? 'Example.pptx' }}</strong>
                    </div>
                </div>
            </div>

            <div class="summary-card mt-4">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

                    <div class="btn-group">
                        <button id="btn-bullet" class="mode-btn active d-flex align-items-center gap-2">
                            <img src="{{ asset('images/fast_forward.png') }}" width="22">
                            Bullet Mode
                        </button>

                        <button id="btn-paragraph" class="mode-btn d-flex align-items-center gap-2">
                            <img src="{{ asset('images/paragraph.png') }}" width="22">
                            Paragraph Mode
                        </button>
                    </div>

                    <div class="d-flex align-items-center gap-2">

                        <button id="generate-question-btn" class="generate-btn d-flex align-items-center gap-2">
                            <img src="{{ asset('images/question.png') }}" width="22">
                            Generate Questions
                        </button>

                        <button id="download-btn" class="download-btn d-flex align-items-center gap-2">

                            <img src="{{ asset('images/download_cloud.png') }}" width="22">

                            Download
                        </button>

                    </div>
                </div>

                <h3 class="fw-bold mb-1">Hasil Ringkasan Materi</h3>
                <p class="text-muted mb-4">Total Slides/Chunks: <span id="total-slides">0</span></p>

                <div id="summary-list">
                </div>
            </div>
        </div>
    </section>

    <section id="how" class="py-5">
        <div class="container">

            <h3 class="fw-bold mb-4 text-center">How NeuroNote Works?</h3>

            <div class="row align-items-center justify-content-center g-3">

                <div class="col-md-3">
                    <div class="card how-card p-4 h-100">
                        <div class="d-flex">
                            <div class="me-3 text-center">
                                <div class="step-circle mb-2">1</div>
                                <img src="{{ asset('images/upload_black.png') }}" width="38">
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Upload Files</h5>
                                <p class="text-muted mb-0">
                                    AI reads the files that you uploaded in the current session.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-1 text-center d-none d-md-block">
                    <img src="{{ asset('images/arrow.png') }}" width="45">
                </div>

                <div class="col-md-3">
                    <div class="card how-card p-4 h-100">
                        <div class="d-flex">
                            <div class="me-3 text-center">
                                <div class="step-circle mb-2">2</div>
                                <img src="{{ asset('images/edit.png') }}" width="38">
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">AI Generates Summary</h5>
                                <p class="text-muted mb-0">
                                    AI will generate the summary based on what it reads.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-1 text-center d-none d-md-block">
                    <img src="{{ asset('images/arrow.png') }}" width="45">
                </div>

                <div class="col-md-3">
                    <div class="card how-card p-4 h-100">
                        <div class="d-flex">
                            <div class="me-3 text-center">
                                <div class="step-circle mb-2">3</div>
                                <img src="{{ asset('images/download.png') }}" width="38">
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">View & Download</h5>
                                <p class="text-muted mb-0">
                                    AI will give a summary in PDF format for you to view and download.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="why" class="py-5">
        <div class="container text-center">

            <h3 class="fw-bold mb-5">Why NeuroNote?</h3>

            <div class="row g-4">

                <div class="col-md-4 d-flex">
                    <div class="card card-shadow why-card p-4 w-100">
                        <div class="icon-box mb-3">
                            <img src="{{ asset('images/Zap.png') }}" width="36">
                        </div>
                        <h5 class="fw-bold">Extremely Fast Process</h5>
                        <p class="text-muted">Get a complete summary in seconds.</p>
                    </div>
                </div>

                <div class="col-md-4 d-flex">
                    <div class="card card-shadow why-card p-4 w-100">
                        <div class="icon-box mb-3">
                            <img src="{{ asset('images/check_circle.png') }}" width="36">
                        </div>
                        <h5 class="fw-bold">Accurate and Relevant</h5>
                        <p class="text-muted">NeuroNote captures key points and filters out irrelevant info.</p>
                    </div>
                </div>

                <div class="col-md-4 d-flex">
                    <div class="card card-shadow why-card p-4 w-100">
                        <div class="icon-box mb-3">
                            <img src="{{ asset('images/check_circle.png') }}" width="36">
                        </div>
                        <h5 class="fw-bold">Free of Charge</h5>
                        <p class="text-muted">NeuroNote offers no charges at all.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $seededSummary = isset($summary)
            ? array_merge(is_array($summary->raw_response) ? $summary->raw_response : [], [
                'file_name' => $summary->file_name,
            ])
            : null;
    @endphp
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
@push('scripts')
    <script>
        function getFileIcon(fileName) {
            if (!fileName) {
                return "{{ asset('images/ppt.png') }}";
            }

            const ext = fileName.split('.').pop().toLowerCase();

            const icons = {
                ppt: "{{ asset('images/ppt.png') }}",
                pptx: "{{ asset('images/ppt.png') }}",
                mp4: "{{ asset('images/mp4.png') }}",
                avi: "{{ asset('images/mp4.png') }}",
                mov: "{{ asset('images/mp4.png') }}",
                default: "{{ asset('images/ppt.png') }}"
            };

            return icons[ext] || icons.default;
        }
        const seededSummary = @json($seededSummary);

        document.addEventListener('DOMContentLoaded', function() {
            if (seededSummary) {
                try {
                    sessionStorage.setItem('last_summary', JSON.stringify(seededSummary));
                } catch (e) {
                    console.error('Failed to seed summary data', e);
                }
            }

            const rawData = sessionStorage.getItem('last_summary');
            if (!rawData) return;
            const data = JSON.parse(rawData);

            let currentMode = 'bullet';

            if (data.file_name) {
                document.getElementById('file-name').innerText = data.file_name;
                document.getElementById('file-icon').src = getFileIcon(data.file_name);
            }
            document.getElementById('total-slides').innerText = data.total_slides;

            const container = document.getElementById('summary-list');

            function renderSummary(isBullet = true) {
                container.innerHTML = '';

                data.slides_summary.forEach((item) => {
                    const section = document.createElement('div');
                    section.className = 'mb-4';

                    let contentHtml = `
                    <h5 class="fw-bold text-primary">
                        ${item.topic}
                        <span class="badge bg-secondary" style="font-size: 10px">Slide/Chunk: ${item.slide_numbers.join(', ')}</span>
                    </h5>
                `;

                    if (isBullet) {
                        const sentences = item.summary.split('. ').filter(s => s.trim() !== '');
                        contentHtml += '<ul>' + sentences.map(s => `<li>${s}.</li>`).join('') + '</ul>';
                    } else {
                        contentHtml +=
                            `<p class="text-dark" style="text-align: justify;">${item.summary}</p>`;
                    }

                    section.innerHTML = contentHtml;
                    container.appendChild(section);
                });
            }

            renderSummary(true);

            const generateBtn = document.getElementById('generate-question-btn');

            generateBtn.addEventListener('click', async function() {

                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                let y = 20;

                doc.setFontSize(18);
                doc.text("NeuroNote Summary", 20, y);
                y += 10;

                doc.setFontSize(12);
                doc.text(`File: ${data.file_name || 'Unknown File'}`, 20, y);
                y += 10;

                data.slides_summary.forEach((item, index) => {

                    doc.setFontSize(14);
                    doc.text(`${index + 1}. ${item.topic}`, 20, y);
                    y += 8;

                    doc.setFontSize(11);

                    const splitText = doc.splitTextToSize(item.summary, 170);
                    doc.text(splitText, 20, y);

                    y += splitText.length * 6 + 5;

                    if (y > 270) {
                        doc.addPage();
                        y = 20;
                    }
                });

                // PDF blob
                const pdfBlob = doc.output('blob');

                // convert to file
                const pdfFile = new File(
                    [pdfBlob],
                    'summary.pdf',
                    { type: 'application/pdf' }
                );

                // buat form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/generate-quiz';
                form.enctype = 'multipart/form-data';

                // csrf
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';

                form.appendChild(csrf);

                // file input
                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.name = 'summary_file';

                // DataTransfer biar file bisa di-assign
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(pdfFile);

                fileInput.files = dataTransfer.files;

                form.appendChild(fileInput);

                document.body.appendChild(form);

                form.submit();
            });

            document.getElementById('btn-bullet').addEventListener('click', function() {
                currentMode = 'bullet';
                this.classList.add('active');
                document.getElementById('btn-paragraph').classList.remove('active');
                renderSummary(true);
            });

            document.getElementById('btn-paragraph').addEventListener('click', function() {
                currentMode = 'paragraph';
                this.classList.add('active');
                document.getElementById('btn-bullet').classList.remove('active');
                renderSummary(false);
            });

            const downloadBtn = document.getElementById('download-btn');

            downloadBtn.addEventListener('click', function() {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();

                let y = 20;

                doc.setFontSize(18);
                doc.text("NeuroNote Summary", 20, y);
                y += 10;

                doc.setFontSize(12);
                doc.text(`File: ${data.file_name || 'Unknown File'}`, 20, y);
                y += 10;

                doc.text(`Total Slides/Chunks: ${data.total_slides}`, 20, y);
                y += 15;

                data.slides_summary.forEach((item, index) => {
                    doc.setFontSize(14);
                    doc.text(`${index + 1}. ${item.topic}`, 20, y);
                    y += 8;

                    doc.setFontSize(11);

                    if (currentMode === 'bullet') {
                        const sentences = item.summary.split('. ').filter(s => s.trim() !== '');

                        sentences.forEach(sentence => {
                            const bulletText = "• " + sentence.trim();
                            const splitText = doc.splitTextToSize(bulletText, 165);
                            doc.text(splitText, 25, y);
                            y += splitText.length * 6;

                            if (y > 270) {
                                doc.addPage();
                                y = 20;
                            }
                        });

                        y += 5;
                    } else {
                        const splitText = doc.splitTextToSize(item.summary, 170);
                        doc.text(splitText, 20, y);
                        y += splitText.length * 6 + 3;
                    }

                    if (y > 270 && index < data.slides_summary.length - 1) {
                        doc.addPage();
                        y = 20;
                    }
                });

                const pdfName = (data.file_name || 'summary').replace(/\.[^/.]+$/, "") + "_summary.pdf";
                doc.save(pdfName);
            });
        });
    </script>
@endpush
