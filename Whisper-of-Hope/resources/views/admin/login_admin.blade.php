<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Yantramanav:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Yantramanav';
            height: 100vh;
            overflow: hidden;
        }

        .login-container {
            position: relative;
            width: 100%;
            height: 100vh;
            background: url('{{ asset('images/background.png') }}') center/cover;
            background-color: #333;
        }

        .background-image {
            display: none;
        }

        .login-form-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .login-form {
            background: rgba(255, 255, 255, 0.7);
            padding: 40px;
            border-radius: 15px;
            width: 400px;
            text-align: center;
            /* box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1); */
            /* border: 1px solid rgba(255, 255, 255, 0.2); */
        }

        .login-form h1 {
            font-size: 3rem;
            margin-bottom: -5px;
            color: black;
            font-weight: bold;
            font-family: 'Yantramanav';
        }

        .login-form p {
            color: black;
            margin-bottom: 30px;
            font-size: 0.9rem;
            font-family: 'Yantramanav';
        }

        .input-group {
            display: flex;
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden;
            /* border: 1px solid #ddd; */
        }

        .input-group-text {
            background-color: #F9BCC4;
            border: none;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-group-text i {
            color: black;
            font-size: 1rem;
        }

        .form-control {
            flex: 1;
            padding: 12px 15px;
            border: none;
            background-color: #F9BCC4;
            font-size: 1rem;
            outline: none;
            color: #333;
            font-family: 'Yantramanav';
        }

        .form-control:focus {
            outline: none;
            /* box-shadow: 0 0 0 2px rgba(233, 30, 99, 0.2); */
        }

        .form-control::placeholder {
            color: black;
            font-size: 0.9rem;
        }

        .toggle-password {
            background-color: #F9BCC4;
            border: none;
            padding: 12px 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .toggle-password:hover {
            background-color: #F9BCC4;
        }

        .toggle-password i {
            color: black;
            font-size: 1rem;
        }

        .login-btn {
            width: 60%;
            padding: 12px;
            background: #F9BCC4;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            color: black;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            font-family: 'Yantramanav';
        }

        .login-btn:hover {
            background: #F9BCC4;
            transform: translateY(-2px);
            /* box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3); */
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .error-message {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 10px;
            text-align: center;
            background: rgba(220, 53, 69, 0.1);
            padding: 10px;
            border-radius: 10px;
            border-left: 4px solid #dc3545;
            font-family: 'Yantramanav';
        }

        .error-message p {
            margin: 0;
        }

        /* Loading state for button */
        .login-btn.loading {
            background: #F9BCC4;
            cursor: not-allowed;    
            pointer-events: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-form {
                width: 90%;
                margin: 0 20px;
                padding: 30px 20px;
            }
            
            .background-image {
                top: 20px;
                right: 20px;
                bottom: 20px;
                left: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        {{-- <div class="background-image"></div> --}}
        <div class="login-form-container">
            <div class="login-form">
                <h1>Welcome!</h1>
                <p>Please log in using admin account</p>
                
                <form method="POST" action="{{ route('admin.login.submit') }}" id="loginForm">
                    @csrf
                    
                    <div class="input-group">
                        <span class="input-group-text">
                            <img src="{{ asset('images/admin/login/email.png') }}" alt="Email" style="width: 16px; height: 16px;">
                        </span>
                        <input type="email" class="form-control" name="email" placeholder="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    
                    <div class="input-group">
                        <span class="input-group-text">
                            <img src="{{ asset('images/admin/login/password.png') }}" alt="Password" style="width: 16px; height: 16px;">
                        </span>
                        <input type="password" class="form-control" name="password" placeholder="password" id="passwordField" required autocomplete="current-password">
                        <span class="toggle-password" id="togglePassword">
                            <img id="eyeIcon" src="{{ asset('images/admin/login/eye_close.png') }}" alt="Toggle Password" style="width: 16px; height: 16px;">
                        </span>
                    </div>
                    
                    @if ($errors->any())
                        <div class="error-message">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if (session('message'))
                        <div class="error-message">
                            <p>{{ session('message') }}</p>
                        </div>
                    @endif
                    
                    <button type="submit" class="login-btn" id="loginBtn">LOGIN</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('passwordField');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.src = '{{ asset("images/admin/login/eye.png") }}';
                eyeIcon.alt = 'Hide Password';
            } else {
                passwordField.type = 'password';
                eyeIcon.src = '{{ asset("images/admin/login/eye_close.png") }}';
                eyeIcon.alt = 'Show Password';
            }
        });

        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loginBtn = document.getElementById('loginBtn');
            
            // Don't prevent default submission, just add loading state
            loginBtn.classList.add('loading');
            loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
        });

        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>