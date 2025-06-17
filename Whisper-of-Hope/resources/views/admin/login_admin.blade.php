<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Whisper of Hope</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
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
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            width: 400px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .login-form h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }

        .login-form p {
            color: #666;
            margin-bottom: 30px;
            font-size: 0.9rem;
        }

        .input-group {
            display: flex;
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .input-group-text {
            background-color: #FFF9EA;
            border: none;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-group-text i {
            color: #888;
            font-size: 1rem;
        }

        .form-control {
            flex: 1;
            padding: 12px 15px;
            border: none;
            background-color: #FFF9EA;
            font-size: 1rem;
            outline: none;
            color: #333;
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(233, 30, 99, 0.2);
        }

        .form-control::placeholder {
            color: #999;
        }

        .toggle-password {
            background-color: #FFF9EA;
            border: none;
            padding: 12px 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .toggle-password:hover {
            background-color: #f0e68c;
        }

        .toggle-password i {
            color: #888;
            font-size: 1rem;
        }

        .login-btn {
            width: 60%;
            padding: 12px;
            background: #FFF9EA;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .login-btn:hover {
            background: #f0e68c;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .error-message {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 10px;
            text-align: left;
            background: rgba(220, 53, 69, 0.1);
            padding: 10px;
            border-radius: 10px;
            border-left: 4px solid #dc3545;
        }

        .error-message p {
            margin: 0;
        }

        /* Loading state for button */
        .login-btn.loading {
            background: #ddd;
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
        <div class="background-image"></div>
        <div class="login-form-container">
            <div class="login-form">
                <h1>Welcome!</h1>
                <p>Please log in using .....</p>
                
                <form method="POST" action="{{ route('admin.login.submit') }}" id="loginForm">
                    @csrf
                    
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control" name="email" placeholder="email" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" name="password" placeholder="password" id="passwordField" required>
                        <span class="toggle-password" id="togglePassword">
                            <i class="bi bi-eye-slash"></i>
                        </span>
                    </div>
                    
                    @if ($errors->any())
                        <div class="error-message">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
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
            const toggleIcon = this.querySelector('i');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        });

        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loginBtn = document.getElementById('loginBtn');
            
            loginBtn.classList.add('loading');
            loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
            
            // Re-enable after 3 seconds if form doesn't submit properly
            setTimeout(() => {
                if (loginBtn.classList.contains('loading')) {
                    loginBtn.classList.remove('loading');
                    loginBtn.innerHTML = 'LOGIN';
                }
            }, 3000);
        });

        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>