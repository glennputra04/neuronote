<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f3f4f6;
        }

        .custom-header {
            background: #60A5FA;
        }

        .login-btn {
            background: #7fb2ea;
            color: white;
            border-radius: 8px;
            padding: 6px 16px;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #5c98dd;
            color: white;
            transform: translateY(-1px);
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
</head>

<body>
    <section id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark custom-header">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">
                    <img src="{{ asset('images/logo.png') }}" height="30" class="me-2">
                    NeuroNote
                </a>

                <div class="ms-auto d-flex align-items-center gap-3">
                    <a class="nav-link text-white" href="#">Home</a>
                    <a class="nav-link text-white" href="#">About Us</a>
                    <a class="btn login-btn btn-sm">Login</a>
                </div>
            </div>
        </nav>
    </section>

    <section id="summary" class="py-4">
        <div class="container">

            <a href="/" class="text-decoration-none text-secondary fw-semibold">
                <img src="{{ asset('images/back.png') }}" width="18">
                Back to Home
            </a>

            <div class="file-box mt-4">
                <div class="file-inner d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/ppt.png') }}" width="40" class="me-3">
                        <strong>Example.pptx</strong>
                    </div>

                    <button class="btn cancel p-0">
                        <img src="{{ asset('images/cancel.png') }}" width="35">
                    </button>

                </div>
            </div>

            <div class="summary-card mt-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="btn-group">
                        <button class="mode-btn active d-flex align-items-center gap-2">
                            <img src="{{ asset('images/fast_forward.png') }}" width="22">
                            Bullet Mode
                        </button>

                        <button class="mode-btn d-flex align-items-center gap-2">
                            <img src="{{ asset('images/paragraph.png') }}" width="22">
                            Paragraph Mode
                        </button>
                    </div>

                    <button class="download-btn d-flex align-items-center gap-2">
                        <img src="{{ asset('images/download_cloud.png') }}" width="22">
                        Download
                    </button>

                </div>

                <h3 class="fw-bold mb-3">Lorem Ipsum Dolor Sit Amet</h3>

                <p class="text-muted">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et
                    dolore magna aliqua...
                </p>

                <div class="mt-4 text-center">
                    <div class="scroll-icon">
                        <img src="{{ asset('images/arrow_down.png') }}" width="35">
                    </div>
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

    <footer class="text-center py-3 bg-light">
        @ 2026 NeuroNote All Rights Reserved
    </footer>
</body>

</html>
