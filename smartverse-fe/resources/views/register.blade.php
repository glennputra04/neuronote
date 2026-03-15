@extends('layouts.app')
@section('title', 'Register - NeuroNote')
@push('styles')
    <style>
        body {
            background: url("/images/background.png") no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .register-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 15px;
        }

        .register-card {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .register-title {
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

        .register-btn {
            background: #3b7ddd;
            border: none;
            border-radius: 30px;
            padding: 12px;
            font-weight: 600;
            margin-top: 15px;
        }

        .register-btn:hover {
            background: #2f65c7;
        }

        .login-text {
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
        <div class="register-wrapper">
            <div class="register-card">
                <h2 class="text-center register-title mb-2">Register</h2>
                <p class="text-center login-text mb-4">Already have an account?
                    <a href="/login" class="text-decoration-underline">Login here</a>
                </p>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Masukkan email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" placeholder="Masukkan nomor telepon">
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-flex justify-content-between align-items-center">
                            Password

                            <span class="toggle-btn" onclick="togglePassword('password','toggleText1', 'toggleIcon1')">
                                <img id="toggleIcon1" src="/images/eye.png" class="password-icon">
                                <span id="toggleText1">Show</span>
                            </span>
                        </label>

                        <input type="password" id="password" class="form-control">
                    </div>


                    <div class="mb-3">
                        <label class="form-label d-flex justify-content-between align-items-center">
                            Confirm Password

                            <span class="toggle-btn"
                                onclick="togglePassword('confirmPassword','toggleText2', 'toggleIcon2')">
                                <img id="toggleIcon2" src="/images/eye.png" class="password-icon">
                                <span id="toggleText2">Show</span>
                            </span>
                        </label>

                        <input type="password" id="confirmPassword" class="form-control">
                    </div>
                    <button type="submit" class="btn register-btn w-100 text-white">Register</button>
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

</html>
