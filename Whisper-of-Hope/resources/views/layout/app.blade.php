<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Whisper of Hope')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gidugu&family=Yantramanav:wght@300;400;500;700&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        /* Sticky Footer Solution */
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .content-wrapper {
            flex: 1 0 auto;
            padding-bottom: 20px; /* Spacing antara konten dan footer */
        }
        .app-footer {
            flex-shrink: 0;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layout.partials.navbar')
    @yield('hero')
    <main class="content-wrapper container mt-4">
        @yield('content')
    </main>
    
    @include('layout.partials.footer')
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>