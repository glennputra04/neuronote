@extends('layouts.app')

@section('title', 'Quiz Results')

@push('styles')
    <style>
        .result-page {
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

        .result-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .result-subtitle {
            font-size: 20px;
            margin-bottom: 18px;
            color: #222;
        }

        .score-box {
            background: #fff;
            border-radius: 6px;
            padding: 30px 20px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .15);
            margin-bottom: 28px;
            text-align: center;
        }

        .score-percent {
            font-size: 72px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 10px;
        }

        .score-good {
            color: #3b82f6;
        }

        .score-bad {
            color: #ef476f;
        }

        .score-message {
            font-size: 26px;
            margin-bottom: 28px;
            color: #222;
        }

        .stat-card {
            background: #fff;
            border-radius: 4px;
            padding: 24px 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
            font-size: 28px;
            font-weight: 700;
            min-height: 84px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .stat-correct {
            color: #3b82f6;
        }

        .stat-incorrect {
            color: #ef476f;
        }

        .corrections-title {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .correction-card {
            background: #fff;
            border-radius: 4px;
            padding: 12px 16px 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .12);
            margin-bottom: 18px;
        }

        .question-number {
            font-weight: 800;
            font-size: 18px;
            margin-bottom: 4px;
        }

        .question-text {
            margin-bottom: 12px;
            color: #444;
        }

        .option-box {
            border: 1px solid #cfcfcf;
            border-radius: 6px;
            min-height: 40px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            width: 100%;
            background: #fff;
            margin-bottom: 10px;
        }

        .option-label {
            margin: 0;
            font-size: 14px;
            color: #444;
            width: 100%;
        }

        .option-radio {
            appearance: none;
            -webkit-appearance: none;

            width: 22px;
            height: 22px;

            border: 2px solid #000;
            border-radius: 50%;

            background-color: #fff !important;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 !important;
            flex-shrink: 0;

            position: relative;
        }

        .option-radio:checked {
            background-color: #fff !important;
            border-color: #000 !important;
        }

        .option-radio:checked::before {
            content: '';

            width: 12px;
            height: 12px;

            border-radius: 50%;
            background: #000;
        }

        .option-radio:focus {
            outline: none;
            box-shadow: none;
        }

        .correct-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #3b82f6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3b82f6;
            font-size: 12px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .home-btn {
            background: #3b82f6;
            border: none;
            border-radius: 6px;
            padding: 14px 42px;
            font-size: 18px;
            font-weight: 700;
        }

        .home-btn:hover {
            background: #2f73df;
        }
    </style>
@endpush

@section('content')
    <div class="result-page">
        <div class="container">
            <a href="{{ url('/') }}" class="back-link">
                <img src="{{ asset('images/back.png') }}" width="18" alt="Back">
                Back to Home
            </a>

            <h1 class="result-title">Quiz Results</h1>

            <p class="result-subtitle">
                @if ($correctCount === $total)
                    Woohoo! You scored <strong>{{ $correctCount }} out of {{ $total }} questions</strong>, great job!
                @else
                    You scored <strong>{{ $correctCount }} out of {{ $total }} questions</strong>, study harder!
                @endif
            </p>

            @php
                $isLowScore = $percent <= 60;
            @endphp

            <div class="score-box">
                <div class="score-percent {{ $isLowScore ? 'score-bad' : 'score-good' }}">
                    {{ $percent }}%
                </div>

                <div class="score-message">
                    {{ $isLowScore ? 'Keep learning!' : 'Keep it up!' }}
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="stat-card stat-correct">
                            {{ $correctCount }} corrects
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card stat-incorrect">
                            {{ $incorrectCount }} incorrects
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            {{ $total }} total
                        </div>
                    </div>
                </div>
            </div>

            <div class="corrections-title">Corrections</div>

            @if (count($corrections) > 0)
                @foreach ($corrections as $correction)
                    <div class="correction-card">
                        <div class="question-number">{{ $correction['title'] }}</div>
                        <div class="question-text">{{ $correction['text'] }}</div>

                        <div class="row g-2">
                            @foreach ($correction['options'] as $optIndex => $option)
                                @php
                                    $isCorrect = $option === $correction['correct_answer'];

                                    $isUser = $option === $correction['user_answer'];
                                @endphp

                                <div class="col-md-6">
                                    <div class="option-box">

                                       

                                        @if ($isCorrect)
                                            <div class="correct-icon">
                                                ★
                                            </div>
                                        @else
                                            <input class="form-check-input option-radio"
                                                type="radio"
                                                disabled
                                                {{ $isUser ? 'checked' : '' }}>

                                        @endif

                                        <label class="option-label">
                                            {{ $option }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <p>No corrections needed</p>
            @endif

            <div class="text-center mt-5">
                <a href="{{ url('/') }}" class="btn home-btn text-white">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
@endsection
