@extends('layouts.app')
@section('title', 'Login - NeuroNote')
@push('styles')
    <style>
        body {
            background: url("/images/background.png") no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .login-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 15px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            color: #3b7ddd;
            font-weight: 700;
        }

        .form-label {
            color: #3B82F6;
            font-weight: 600;
        }

        .form-control {
            border: 1px solid #3B82F6;
            border-radius: 8px;
            padding: 10px 14px;
            color: #3B82F6;
        }

        .form-control::placeholder {
            color: #3B82F6;
            opacity: 0.8;
        }

        .form-control:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.2);
            color: #3B82F6;
        }

        .form-check-input {
            width: 1.15em;
            height: 1.15em;
            border: 2px solid #3B82F6;
        }

        .form-check-input:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.2);
        }

        .form-check-input:checked {
            background-color: #3B82F6;
            border-color: #3B82F6;
        }

        .login-submit {
            background: #3b7ddd;
            border: none;
            border-radius: 30px;
            padding: 12px;
            font-weight: 600;
            margin-top: 15px;
        }

        .login-submit:hover {
            background: #2f65c7;
        }

        .register-text {
            font-size: 14px;
        }

        .toggle-btn {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            color: #3b7ddd;
        }

        .password-icon {
            width: 20px;
            height: 20px;
        }
    </style>
@endpush
@section('content')
    <div>
        <div class="login-wrapper">
            <div class="login-card">
                <h2 class="text-center login-title mb-2">Login</h2>
                <p class="text-center register-text mb-4">Don't have an account?
                    <a href="/register" class="text-decoration-underline">Register here</a>
                </p>
                @if (session('status'))
                    <div class="alert alert-success py-2" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger py-2" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-flex justify-content-between align-items-center">
                            Password

                            <span class="toggle-btn" onclick="togglePassword('password','toggleText1', 'toggleIcon1')">
                                <img id="toggleIcon1" src="/images/eye.png" class="password-icon">
                                <span id="toggleText1">Show</span>
                            </span>
                        </label>

                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                    <button type="submit" class="btn login-submit w-100 text-white">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function togglePassword(inputId, textId, iconId) {

            const input = document.getElementById(inputId);
            const text = document.getElementById(textId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                text.innerText = "Hide";
                icon.src = "/images/eye-slash.png";
            } else {
                input.type = "password";
                icon.src = "/images/eye.png";
                text.innerText = "Show";
            }
        }
    </script>
@endpush
