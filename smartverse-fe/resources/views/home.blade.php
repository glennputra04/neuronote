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
            background: linear-gradient(220deg, #d9e7fc, #B8D8FF);
            padding: 70px 0;
            color: white;
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
            border-radius: 15px;
            background: white;
            padding: 60px 20px;
            text-align: center;
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
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-6">
                    <h1 class="fw-bold custom-black">
                        Summarize PPTs & Videos in<br>
                        <span class="fw-bold custom-blue">Seconds</span> <span class="fw-bold custom-black">and</span>
                        <span class="fw-bold custom-blue">Free</span>
                        <img src="{{ asset('images/lightning.png') }}" height="40" class="ms-0.5">

                    </h1>

                    <p class="mt-3 custom-black">
                        Perfect for busy students. Save time, study more.
                    </p>

                    <div class="mt-4 d-flex gap-3 flex-wrap">
                        <button class="btn btn-primary btn-lg me-3 d-flex align-items-center">
                            <img src="{{ asset('images/folder.png') }}" height="22" class="me-2">
                            Upload PPT
                        </button>

                        <button class="btn btn-primary btn-lg me-3 d-flex align-items-center">
                            <img src="{{ asset('images/upload.png') }}" height="22" class="me-2">
                            Upload Video
                        </button>

                    </div>
                </div>

                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/hero.png') }}" class="img-fluid" style="max-height:320px">
                </div>

            </div>
        </div>
    </section>

    <section class="py-5">
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
                    <span><img src="{{ asset('images/arrow.png') }}" width="45"></span>
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
                    <span><img src="{{ asset('images/arrow.png') }}" width="45"></span>
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

    <section class="pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="upload-box">

                        <div class="upload-icon-wrap mb-3">
                            <img src="{{ asset('images/upload.png') }}" width="40">
                        </div>


                        <h4>Upload PPT / Video here</h4>
                        <p class="text-muted">Drag & drop or click to choose file</p>

                        <button class="btn btn-primary mt-3">Choose File</button>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
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
@endsection
