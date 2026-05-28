@extends('layouts.app')

@section('title', 'Quiz Time!')

@push('styles')
    <style>
        .quiz-page {
            background: #ffffff;
            min-height: calc(100vh - 75px);
            padding: 24px 0 40px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #7a7a7a;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 14px;
        }

        .back-link:hover {
            color: #4b4b4b;
        }

        .quiz-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 2px;
        }

        .quiz-subtitle {
            color: #6b7280;
            margin-bottom: 18px;
        }

        .question-card {
            background: #fff;
            border: 1px solid #d9d9d9;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .10);
            margin-bottom: 16px;
            padding: 10px 12px 14px;
        }

        .question-number {
            font-weight: 800;
            font-size: 16px;
            margin-bottom: 4px;
        }

        .question-text {
            font-size: 14px;
            color: #444;
            margin-bottom: 10px;
        }

        .option-box {
            border: 1px solid #cfcfcf;
            border-radius: 5px;
            min-height: 36px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            background: #fff;
            width: 100%;
        }

        .option-radio {
            margin: 0 !important;
            flex: 0 0 auto;
            width: 18px;
            height: 18px;
            transform: none;

            appearance: auto;
            accent-color: black !important;
        }

        .option-radio:checked {
            background-color: #000 !important;
            border-color: #000 !important;
        }

        .option-radio:focus {
            box-shadow: none !important;
            outline: none !important;
        }

        .option-label {
            font-size: 13px;
            color: #4a4a4a;
            margin: 0;
            cursor: pointer;
            width: 100%;
        }

        .finish-btn {
            background: #4f8df7;
            border: none;
            border-radius: 6px;
            padding: 14px 38px;
            font-size: 18px;
            font-weight: 700;
            box-shadow: 0 2px 6px rgba(79, 141, 247, .25);
        }

        .finish-btn:hover {
            background: #3f7fe8;
        }

        @media (max-width: 768px) {
            .quiz-title {
                font-size: 26px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="quiz-page">
        <div class="container">
            <a href="/" class="text-decoration-none text-secondary fw-semibold back-link mb-4">
                <img src="{{ asset('images/back.png') }}" width="18" alt="Back">
                Back to Home
            </a>

            <h1 class="quiz-title">Quiz Time!</h1>
            <p class="quiz-subtitle">Test your understanding with generated questions from your summary</p>

            <form action="{{ url('/quiz-result') }}" method="POST">
                @csrf

                @foreach ($questions as $question)
                    <div class="question-card">
                        <div class="question-number">{{ $question['title'] }}</div>
                        <div class="question-text">{{ $question['text'] }}</div>

                        <div class="row g-2">
                            @foreach ($question['options'] as $optIndex => $option)
                                <div class="col-md-6">
                                    <div class="option-box">
                                        <input class="form-check-input option-radio" type="radio"
                                            name="{{ $question['name'] }}" id="{{ $question['name'] }}_{{ $optIndex }}"
                                            value="{{ $optIndex }}">
                                        <label class="form-check-label option-label"
                                            for="{{ $question['name'] }}_{{ $optIndex }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="text-center mt-5">
                    <button type="submit" class="btn finish-btn text-white">
                        Finish Quiz
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
