<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('auth.reset_password') }} - Whisper of Hope</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Yantramanav:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Yantramanav';
            background: linear-gradient(135deg, #F9BCC4, #FFDBDF);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .reset-container {
            background: #FFF9EA;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .reset-header h2 {
            color: #333;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 5px;
        }
        
        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            margin-bottom: 20px;
        }
        
        .form-control:focus {
            border-color: #F9BCC4;
            box-shadow: 0 0 0 0.2rem rgba(249, 188, 196, 0.25);
        }
        
        .btn-reset {
            background: #F9BCC4;
            border: none;
            color: #333;
            font-weight: 600;
            padding: 10px;
            border-radius: 10px;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
        }
        
        .btn-reset:hover {
            background: #F791A9;
            color: #333;
            transform: translateY(-2px);
        }
        
        .text-danger {
            font-size: 0.9rem;
            margin-top: -15px;
            margin-bottom: 15px;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: black;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .back-link a:hover {
            color: #F791A9;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-header">
            <h2>{{ __('auth.reset_password') }}</h2>
        </div>
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            
            <div class="mb-3">
                <label class="form-label">{{ __('auth.new_password') }}</label>
                <input type="password" name="password" class="form-control" required minlength="8">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">{{ __('auth.confirm_new_password') }}</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-reset">{{ __('auth.reset_password') }}</button>
            
            <div class="back-link">
                <a href="{{ route('login') }}">{{ __('auth.back_to_login') }}</a>
            </div>
        </form>
    </div>
</body>
</html>