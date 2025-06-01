<?php

use Illuminate\Support\Facades\Route;

// Main welcome page
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Authentication routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// User routes
Route::prefix('user')->group(function () {
    Route::get('/about', function () {
        return view('user.about');
    })->name('user.about');
    
    Route::get('/community', function () {
        return view('user.community');
    })->name('user.community');
    
    Route::get('/donate', function () {
        return view('user.donate');
    })->name('user.donate');
    
    Route::get('/request', function () {
        return view('user.request');
    })->name('user.request');
    
    Route::get('/whisper', function () {
        return view('user.whisper');
    })->name('user.whisper');

});

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    
    // Registration Routes
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    
    // Password Reset Routes
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
         ->name('password.request');
});

// Password Reset Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
     ->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
     ->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
     ->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])
     ->name('password.update');

// Registration
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
     ->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
     ->name('password.email');