<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - My App</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gidugu&family=Yantramanav:wght@300;400;500;700&display=swap">
    
    @stack('styles')
    
    <style>
        body, .navbar, .footer, .modal-content, .dropdown-menu, .btn, .form-control {
            font-family: 'Yantramanav', Arial, sans-serif !important;
        }

        .gidugu-title, .modal-title, h1.gidugu, h2.gidugu, h3.gidugu, h4.gidugu {
            font-family: 'Gidugu', Arial, sans-serif !important;
            letter-spacing: 1px;
        }
        .navbar {
            background-color: #FFDBDF !important;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.10);
            font-family: 'Yantramanav', Arial, sans-serif !important;
        }

        footer {
            background-color: #FFDBDF !important;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.10);
            font-family: 'Yantramanav', Arial, sans-serif !important;
        }
        
        html, body {
            height: 100%;
        }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
        .profile-overlay {
            position: fixed;
            top: 60px;
            right: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            padding: 15px;
            z-index: 1000;
            display: none;
            min-width: 200px;
        }
        .profile-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
        .profile-img-sm {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    @include('layout.partials.navbar')
    <main class="py-4">
        @yield('content')
    </main>
    @include('layout.partials.footer')
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @stack('scripts')
    
    <script>
        $(document).ready(function() {
            // Toggle profile overlay
            $('#profileDropdown').click(function(e) {
                e.stopPropagation();
                $('#profileOverlay').toggle();
            });
            
            // Close profile overlay when clicking outside
            $(document).click(function() {
                $('#profileOverlay').hide();
            });
            
            // Initialize Bootstrap tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>

    @if(session('showLogin'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        });
    </script>
    @endif
</body>
</html>