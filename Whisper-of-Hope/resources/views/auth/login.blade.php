@extends('layout.app')

@section('title', 'Login')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center" style="background: #f8fafc;">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="login-container shadow-lg">
                <h2 class="login-title mb-4">LOGIN</h2>
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="Enter your email" 
                            required 
                            autocomplete="email" 
                            autofocus
                        >
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            placeholder="Enter your password" 
                            required 
                            autocomplete="current-password"
                        >
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-login">LOGIN</button>
                    
                    <div class="register-link mt-4">
                        Don't have an account? <a href="{{ route('register') }}">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .login-container {
        background-color: #fff;
        padding: 2.5rem 2rem;
        border-radius: 16px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }
    .login-title {
        text-align: center;
        font-weight: 700;
        color: #0d6efd;
        letter-spacing: 1px;
    }
    .form-label {
        font-weight: 500;
    }
    .form-control {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border: 1px solid #ced4da;
        margin-bottom: 0.5rem;
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.15);
    }
    .btn-login {
        width: 100%;
        padding: 0.75rem;
        font-weight: bold;
        background-color: #0d6efd;
        border: none;
        border-radius: 8px;
        transition: background 0.2s;
    }
    .btn-login:hover {
        background-color: #0b5ed7;
    }
    .forgot-password-link {
        font-size: 0.95rem;
        color: #6c757d;
        text-decoration: none;
        transition: color 0.2s;
    }
    .forgot-password-link:hover {
        color: #0d6efd;
        text-decoration: underline;
    }
    .register-link {
        text-align: center;
        font-size: 1rem;
    }
    .register-link a {
        text-decoration: none;
        font-weight: bold;
        color: #0d6efd;
        transition: color 0.2s;
    }
    .register-link a:hover {
        color: #0b5ed7;
        text-decoration: underline;
    }
    .alert-danger {
        border-radius: 8px;
        font-size: 0.97rem;
    }
</style>
@endsection