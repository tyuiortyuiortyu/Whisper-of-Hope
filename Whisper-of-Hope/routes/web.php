<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\WhisperController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ComStoryController;
use App\Http\Controllers\DonateHairController;
use App\Http\Controllers\User\RequestWigController;

// Main welcome page
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// User routes
Route::prefix('user')->group(function () {
    Route::get('/about', function () {
        return view('user.about');
    })->name('user.about');
    
    Route::get('/community', [ComStoryController::class, 'index'])->name('user.community');
    Route::get('/community/story/{id}', [ComStoryController::class, 'show'])->name('community.story');

    // Route::resource('community', ComStoryController::class);
    
    Route::get('/donate', function () {
        return view('user.donate');
    })->name('user.donate');
    
    Route::get('/request', function () {
        return view('user.request');
    })->name('user.request');
    
    Route::get('/whisper', [WhisperController::class, 'index'])->name('user.whisper');
});


// API routes for whispers
Route::prefix('api/whispers')->group(function () {
    Route::get('/', [WhisperController::class, 'getWhispers'])->name('api.whispers.index');
    Route::post('/', [WhisperController::class, 'store'])->name('api.whispers.store');
});

// API routes for colors
Route::get('api/colors', [WhisperController::class, 'getColors'])->name('api.colors.index');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Forgot Password (request link)
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password (reset form)
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


// Donate Hair Routes
Route::post('/donate-hair', [DonateHairController::class, 'store'])
    ->middleware('auth')
    ->name('donate.hair.store');
Route::get('/donate-hair', [DonateHairController::class, 'showDonatePage'])
    ->middleware('auth')
    ->name('donate.hair');


Route::post('/donate-hair', [DonateHairController::class, 'store'])->name('donate.hair.store');


// Request Wig Routes
Route::get('/request-wig', [RequestWigController::class, 'showRequestPage'])->middleware('auth')->name('request.wig');
Route::post('/request-wig', [RequestWigController::class, 'storeRequest'])->middleware('auth')->name('request.wig.storeRequest');