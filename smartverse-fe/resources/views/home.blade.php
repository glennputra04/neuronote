@extends('layouts.app')
@section('title', 'Home - NeuroNote')
@push('styles')
    <style>
        body {
            background: #f3f4f6;
        }

        .custom-blue {
            color: #1e3a8a;
        }

        .custom-black {
            color: black;
        }

        .hero {
            background: linear-gradient(200deg, #ffffff, #B8D8FF);
            padding: 70px 0;
            color: white;
        }

        .hero-inner {
            max-width: 1200px;
            margin: auto;
            padding: 0 40px;
        }

        .hero h1 {
            font-size: 3.5rem;
            line-height: 1.2;
        }

        .hero h1 span {
            font-size: 3.5rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-top: 20px;
        }

        .btn-upload {
            background: #60A5FA;
            color: white;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-upload:hover {
            background: #5c98dd;
            color: white;
            transform: translateY(-1px);
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

        .upload-box {
            border: 2px dashed #8ab0e6;
            border-radius: 16px;
            background: white;
            padding: 70px 30px;
            text-align: center;
            cursor: pointer;
        }

        .upload-action {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            color: grey;
            font-weight: 600;
            transition: 0.25s;
        }

        .upload-action:hover {
            color: black;
            transform: translateY(-2px);
        }

        .upload-formats img {
            opacity: 0.6;
            margin-right: 6px;
        }

        .upload-icon-wrap {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            background: #4f8fe8;
            display: flex;
            align-items: center;
            justify-content: center;
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
    <section class="hero">
        <div class="hero-inner">
            <div class="row align-items-center">

                <div class="col-md-6">
                    <h1 class="fw-bold custom-black">
                        Summarize PPTs & Videos in<br>
                        <span class="fw-bold custom-blue">Seconds</span> <span class="fw-bold custom-black">and</span>
                        <span class="fw-bold custom-blue">Free</span>
                        <img src="{{ asset('images/lightning.png') }}" height="40" class="ms-0.5">

                    </h1>

                    <p class="mt-4 mb-4 custom-black">
                        Perfect for busy students. Save time, study more.
                    </p>

                    <div class="mt-5 d-flex gap-4 flex-wrap">
                        <button id="btn-upload-ppt" class="btn btn-primary btn-lg me-3 d-flex align-items-center">
                            <img src="{{ asset('images/folder.png') }}" height="22" class="me-2">
                            Upload PPT
                        </button>

                        <button id="btn-upload-video" class="btn btn-upload btn-lg me-3 d-flex align-items-center">
                            <img src="{{ asset('images/upload.png') }}" height="22" class="me-2">
                            Upload Video
                        </button>

                    </div>
                </div>

                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/hero.png') }}" class="img-fluid" style="max-height:350px">
                </div>

            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h3 class="fw-bold mb-4 text-center">How NeuroNote Works?</h3>
            <div class="row align-items-stretch justify-content-center g-2">
                <div class="col-md-3 d-flex">
                    <div class="card how-card p-4 h-100 w-100">
                        <div class="d-flex">
                            <div class="me-3 text-center">
                                <div class="step-circle mb-2">1</div> <img src="{{ asset('images/upload_black.png') }}"
                                    width="38">
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Upload Files</h5>
                                <p class="text-muted mb-0"> AI reads the files that you uploaded in the current session.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto d-flex align-items-center"> <span><img src="{{ asset('images/arrow.png') }}"
                            width="35"></span> </div>

                <div class="col-md-3 d-flex">
                    <div class="card how-card p-4 h-100 w-100">
                        <div class="d-flex">
                            <div class="me-3 text-center">
                                <div class="step-circle mb-2">2</div> <img src="{{ asset('images/edit.png') }}"
                                    width="38">
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">AI Generates Summary</h5>
                                <p class="text-muted mb-0"> AI will generate the summary based on what it reads. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto d-flex align-items-center"> <span><img src="{{ asset('images/arrow.png') }}"
                            width="35"></span> </div>
                <div class="col-md-3 d-flex">
                    <div class="card how-card p-4 h-100 w-100">
                        <div class="d-flex">
                            <div class="me-3 text-center">
                                <div class="step-circle mb-2">3</div> <img src="{{ asset('images/download.png') }}"
                                    width="38">
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">View & Download</h5>
                                <p class="text-muted mb-0"> AI will give a summary in PDF format for you to view and
                                    download. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">

                    <div class="upload-box" id="upload-area">

                        <div class="upload-icon-wrap mb-3">
                            <img src="{{ asset('images/upload.png') }}" width="40">
                        </div>


                        <h4>Upload PPT / Video here</h4>
                        <p class="text-muted" id="file-label">Drag & drop or click to choose file</p>

                        <input type="file" id="main-file-input" style="display: none;"
                            accept=".ppt,.pptx,.pdf,.mp4,.avi">

                        <button id="choose-btn" class="btn btn-primary mt-3"
                            onclick="document.getElementById('main-file-input').click()">
                            Choose File
                        </button>

                        <div id="loading-status" class="mt-3" style="display: none;">
                            <div class="spinner-border text-primary spinner-border-sm" role="status"></div>
                            <span class="ms-2">Processing your file...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container-fluid text-center px-5">

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
@endsection

@push('scripts')
    <script>
        const btnUploadPpt = document.getElementById('btn-upload-ppt');
        const btnUploadVideo = document.getElementById('btn-upload-video');

        // Klik Upload PPT
        btnUploadPpt.addEventListener('click', function() {
            fileInput.accept = ".ppt,.pptx,.pdf"; // filter PPT
            fileInput.click();
        });

        // Klik Upload Video
        btnUploadVideo.addEventListener('click', function() {
            fileInput.accept = ".mp4,.avi,.mkv"; // filter video
            fileInput.click();
        });

        const uploadArea = document.getElementById('upload-area');

        uploadArea.addEventListener('click', function(e) {
            if (e.target.closest('button')) return

            fileInput.click();
        });

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#3b82f6';
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = '#8ab0e6';
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });

        const fileInput = document.getElementById('main-file-input');
        const fileLabel = document.getElementById('file-label');
        const loadingStatus = document.getElementById('loading-status');
        const chooseBtn = document.getElementById('choose-btn');

        fileInput.addEventListener('change', async function() {
            if (this.files.length === 0) return;

            const file = this.files[0];
            fileLabel.innerText = "Selected: " + file.name;
            chooseBtn.disabled = true;
            fileInput.disabled = true;

            // Buat FormData untuk dikirim
            const formData = new FormData();
            formData.append('file', file);
            formData.append('_token', '{{ csrf_token() }}'); // CSRF Protection Laravel

            // Tampilkan loading
            loadingStatus.style.display = 'block';

            // console.log(file)

            try {
                const response = await fetch('/summarize', {
                    method: 'POST',
                    body: formData
                });
                
                console.log(response)
                const result = await response.json();

                if (response.ok) {
                    result.file_name = file.name;
                    sessionStorage.setItem('last_summary', JSON.stringify(result));
                    window.location.href = '/summary';
                } else {
                    alert("Error: " + (result.message || "Failed to process file"));
                }
            } catch (error) {
                console.error(error);
                alert("Connection to AI server failed.");
            } finally {
                loadingStatus.style.display = 'none';
                resetUI();
            }
        });

        function resetUI() {
            chooseBtn.disabled = false;
            fileInput.disabled = false;
            chooseBtn.innerText = "Choose File";
            loadingStatus.style.display = 'none';
        }
    </script>
@endpush
