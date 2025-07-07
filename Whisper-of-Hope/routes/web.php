<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\User\Auth\ResetPasswordController;

use App\Http\Controllers\User\WhisperController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ComStoryController;
use App\Http\Controllers\User\DonateHairController;
use App\Http\Controllers\User\RequestWigController;

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\RequestAdminController;
use App\Http\Controllers\Admin\DonateAdminController;
use App\Http\Controllers\Admin\WhisperAdminController;
use App\Http\Controllers\Admin\CommunityAdminController;
use App\Http\Controllers\Admin\StoryController;

// Main welcome page (accessible to everyone - no middleware)
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Language switching route
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// User routes (accessible to everyone - no middleware needed for public pages)
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

// API routes for whispers (accessible to everyone)
Route::prefix('api/whispers')->group(function () {
    Route::get('/', [WhisperController::class, 'getWhispers'])->name('api.whispers.index');
    Route::post('/', [WhisperController::class, 'store'])->name('api.whispers.store');
    Route::delete('/{id}', [WhisperAdminController::class, 'destroy'])->name('api.whispers.destroy')->middleware('admin');
});

// API routes for colors
Route::get('api/colors', [WhisperController::class, 'getColors'])->name('api.colors.index');

// Admin API routes for whispers
Route::prefix('admin/api')->middleware('admin')->group(function () {
    Route::get('/whispers', [WhisperAdminController::class, 'getWhispers'])->name('admin.api.whispers.index');
    Route::get('/colors', [WhisperAdminController::class, 'getColors'])->name('admin.api.colors.index');
    Route::post('/whispers', [WhisperAdminController::class, 'store'])->name('admin.api.whispers.store');
});

// User Authentication Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Authenticated user routes (any logged in user)
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// User-specific routes (only users with 'user' role)
Route::middleware(['user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/donate-hair', [DonateHairController::class, 'store'])->name('donate.hair.store');
    Route::get('/donate-hair', [DonateHairController::class, 'showDonatePage'])->name('donate.hair');
    Route::get('/request-wig', [RequestWigController::class, 'showRequestPage'])->name('request.wig');
    Route::post('/request-wig', [RequestWigController::class, 'storeRequest'])->name('request.wig.storeRequest');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin Login Routes (Guest middleware - only for non-authenticated)
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    });
    
    // Admin Protected Routes (Admin middleware - only admins)
    Route::middleware(['admin'])->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('/users', [UserAdminController::class, 'index'])->name('admin.user_admin');
        Route::post('/users', [UserAdminController::class, 'create'])->name('admin.users.create');
        Route::put('/users/{user}', [UserAdminController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [UserAdminController::class, 'destroy'])->name('admin.users.destroy');
        
        Route::get('/requests', [RequestAdminController::class, 'index'])->name('admin.request_admin');
        Route::get('/requests/{hairRequest}', [RequestAdminController::class, 'show'])->name('admin.requests.show');
        Route::patch('/requests/{hairRequest}/accept', [RequestAdminController::class, 'accept'])->name('admin.requests.accept');
        Route::patch('/requests/{hairRequest}/reject', [RequestAdminController::class, 'reject'])->name('admin.requests.reject');
        Route::delete('/requests/{hairRequest}', [RequestAdminController::class, 'destroy'])->name('admin.requests.destroy');
        
        Route::get('/donations', [DonateAdminController::class, 'index'])->name('admin.donate_admin');
        Route::get('/whisper', [WhisperAdminController::class, 'index'])->name('admin.whisper_admin');
        Route::get('/community', [CommunityAdminController::class, 'index'])->name('admin.community_admin');

        
       // Donation Management
    Route::get('/donations', [DonateAdminController::class, 'index'])->name('admin.donate_admin');
    Route::put('/donations/{hairDonation}/approve', [DonateAdminController::class, 'approve'])->name('admin.donations.approve');
    Route::put('/donations/{hairDonation}/reject', [DonateAdminController::class, 'reject'])->name('admin.donations.reject');
    Route::delete('/donations/{hairDonation}', [DonateAdminController::class, 'destroy'])->name('admin.donations.destroy');
        
        // Whisper Management
        Route::get('/whisper', [WhisperAdminController::class, 'index'])->name('admin.whisper_admin');
        
        // Community Stories Management
        Route::get('/community', [CommunityAdminController::class, 'index'])->name('admin.community_admin');
        Route::get('community/preview/add-new-story', [CommunityAdminController::class, 'create'])->name('admin.community_admin_addPreview');
        Route::post('community/add', [CommunityAdminController::class, 'store'])->name('admin.community_admin_add');
        Route::get('/community/preview/{story}/edit', [CommunityAdminController::class, 'edit'])->name('admin.community_admin_edit');
        Route::put('/community/update/{story}', [CommunityAdminController::class, 'update'])->name('admin.community_admin_update');
        Route::delete('/community/delete/{story}', [CommunityAdminController::class, 'destroy'])->name('admin.community_admin_delete');
    });
});

// Request Wig Routes (User middleware - only users)
Route::middleware('user')->group(function () {
    Route::get('/request-wig', [RequestWigController::class, 'showRequestPage'])->name('request.wig');
    Route::post('/request-wig', [RequestWigController::class, 'storeRequest'])->name('request.wig.storeRequest');
});

// Debug route (remove this in production)
Route::get('/debug-locale', function() {
    return view('debug-locale');
});
