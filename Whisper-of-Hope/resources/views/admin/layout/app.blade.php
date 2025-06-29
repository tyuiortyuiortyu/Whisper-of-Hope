<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin</title>
    
    
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
        @import url('https://fonts.googleapis.com/css2?family=Yantramanav:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Yantramanav';
        }

        /* Hide scrollbars */
        * {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* Internet Explorer 10+ */
        }
        
        *::-webkit-scrollbar {
            display: none; /* WebKit */
        }

        body {
            background-color: white;
            overflow-x: hidden;
        }

        html {
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            background: white;
            transition: margin-left 0.3s ease;
        }

        .top-header {
            background: #ffffff;
            color: black;
            padding: 10px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 10;
        }

        .top-header h1 {
            font-family: 'Gidugu';
            font-size: 4rem;
            font-weight: 400;
            margin-left: 20px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .notification-btn {
            position: relative;
            background: none;
            border: none;
            color: black;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: background-color 0.3s ease;
        }

        .notification-btn:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #ff4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: black;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px;
        }

        .content-area {
            padding: 30px;
            min-height: calc(100vh - 80px);
            background: white;
        }

        .page-content {
            background: white;
            border-radius: 10px;
            box-shadow: none;
            overflow: hidden;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .top-header {
                padding-left: 60px;
                position: relative;
            }
            
            .menu-toggle {
                position: absolute;
                left: 20px;
                top: 50%;
                transform: translateY(-50%);
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.layout.partials.navbar')
        
        <div class="main-content">
            <header class="top-header">
                <h1>@yield ('title')</h1>
            </header>
            
            <div class="content-area">
                <div class="page-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script src="{{ asset('js/admin/main.js') }}"></script>
    @stack('scripts')
    
    <script>
        // Mobile menu toggle
        document.getElementById('menuToggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.querySelector('.sidebar');
            const menuToggle = document.getElementById('menuToggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(e.target) && 
                !menuToggle.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>
</html>