@extends('layout.app')

@section('title', 'Login')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="login-container p-4" style="background-color: #F9BCC4;">
                <!-- Close Button (X icon) -->
                <button type="button" class="btn-close position-absolute" style="top: 15px; right: 15px; background-image: url('/icons/close'); background-size: contain;"></button>
                
                <h2 class="login-title text-center mb-4">LOGIN</h2>
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-3 position-relative">
                        <img src="/icons/email" alt="Email" class="position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); width: 20px;">
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="email" 
                            required 
                            autocomplete="email" 
                            autofocus
                            style="background-color: #FFF9EA; padding-left: 45px;"
                        >
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3 position-relative">
                        <img src="/icons/password" alt="Password" class="position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); width: 20px;">
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror password-field" 
                            id="password" 
                            name="password" 
                            placeholder="password" 
                            required 
                            autocomplete="current-password"
                            style="background-color: #FFF9EA; padding-left: 45px;"
                        >
                        <img src="/icons/eye" alt="Show Password" class="position-absolute toggle-password" style="right: 15px; top: 50%; transform: translateY(-50%); width: 20px; cursor: pointer;">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember" style="color: #000;">
                                Remember Me
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-login w-100 mb-3" style="background-color: #FFF9EA; color: #000;">LOGIN</button>
                    
                    <div class="register-link text-center">
                        Don't have any account? <a href="{{ route('register') }}">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .login-container {
        border-radius: 8px;
        width: 100%;
        max-width: 350px;
        position: relative;
    }
    
    .login-title {
        font-weight: bold;
        color: #000;
        font-size: 24px;
    }
    
    .form-control {
        padding: 12px 15px;
        border-radius: 4px;
        border: 1px solid #ddd;
        margin-bottom: 15px;
        width: 100%;
    }
    
    .form-control:focus {
        border-color: #aaa;
        outline: none;
        box-shadow: none;
    }
    
    .btn-login {
        padding: 12px;
        border: none;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }
    
    .btn-login:hover {
        background-color: #EEE9D1 !important;
    }
    
    .forgot-password-link {
        color: #666;
        text-decoration: none;
        font-size: 14px;
    }
    
    .forgot-password-link:hover {
        text-decoration: underline;
    }
    
    .register-link {
        color: #666;
        font-size: 14px;
    }
    
    .register-link a {
        color: #000;
        text-decoration: none;
        font-weight: bold;
    }
    
    .register-link a:hover {
        text-decoration: underline;
    }
    
    .btn-close {
        border: none;
        background-color: transparent;
        width: 20px;
        height: 20px;
        padding: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('.toggle-password');
        const passwordField = document.querySelector('.password-field');
        let isPasswordVisible = false;
        
        togglePassword.addEventListener('click', function() {
            isPasswordVisible = !isPasswordVisible;
            passwordField.type = isPasswordVisible ? 'text' : 'password';
            togglePassword.src = isPasswordVisible ? '/icons/close_eye' : '/icons/eye';
        });
    });
</script>
@endsection