<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --footer-height: 75px;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        .page-footer {
            background-color: transparent !important;
            height: var(--footer-height);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 12px;
            margin-top: auto;
        }
    </style>
    @stack('styles')

</head>

<body>

    {{-- HEADER --}}
    <nav class="navbar navbar-expand-lg navbar-dark custom-header">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <img src="{{ asset('images/logo.png') }}" height="30" class="me-2">
                NeuroNote
            </a>

            <div class="ms-auto d-flex align-items-center gap-3">
                <a class="nav-link text-white" href="/">Home</a>
                <a class="nav-link text-white" href="#">About Us</a>
                <a class="btn login-btn btn-sm" href="/login">Login</a>
            </div>
        </div>
    </nav>


    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>


    {{-- FOOTER --}}
    <footer class="page-footer text-center">
        @ 2026 NeuroNote All Rights Reserved
    </footer>
    @stack('scripts')
</body>

</html>
