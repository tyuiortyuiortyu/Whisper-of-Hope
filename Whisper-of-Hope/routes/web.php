<?php

use Illuminate\Support\Facades\Route;

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

// User logout (accessible to all authenticated users)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Profile Routes (User middleware - only users)
Route::middleware('user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Debug route to check profile data (remove in production)
    Route::get('/debug/profile', function () {
        $user = auth()->user();
        return response()->json([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'profile_image' => $user->profile_image,
            'profile_image_url' => $user->profile_image ? asset('storage/' . $user->profile_image) : null,
            'profile_image_exists' => $user->profile_image ? \Storage::disk('public')->exists($user->profile_image) : false,
            'updated_at' => $user->updated_at,
            'created_at' => $user->created_at,
        ]);
    });
});

// Donate Hair Routes (User middleware - only users)
Route::middleware('user')->group(function () {
    Route::post('/donate-hair', [DonateHairController::class, 'store'])->name('donate.hair.store');
    Route::get('/donate-hair', [DonateHairController::class, 'showDonatePage'])->name('donate.hair');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin Login Routes (No middleware - accessible to everyone)
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    
    // Admin Protected Routes (Admin middleware - only admins)
    Route::middleware('admin')->group(function () {
        // Admin logout (only for admins)
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        
        // User Management
        Route::get('/users', [UserAdminController::class, 'index'])->name('admin.user_admin');
        Route::post('/users', [UserAdminController::class, 'create'])->name('admin.users.create');
        Route::put('/users/{user}', [UserAdminController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [UserAdminController::class, 'destroy'])->name('admin.users.destroy');
        
        // Request Management
        Route::get('/requests', [RequestAdminController::class, 'index'])->name('admin.request_admin');
        
        // Donation Management
        Route::get('/donations', [DonateAdminController::class, 'index'])->name('admin.donate_admin');
        
        // Whisper Management
        Route::get('/whisper', [WhisperAdminController::class, 'index'])->name('admin.whisper_admin');
        
        // Community Stories Management
        Route::get('/community', [CommunityAdminController::class, 'index'])->name('admin.community_admin');
    });
});

// Request Wig Routes (User middleware - only users)
Route::middleware('user')->group(function () {
    Route::get('/request-wig', [RequestWigController::class, 'showRequestPage'])->name('request.wig');
    Route::post('/request-wig', [RequestWigController::class, 'storeRequest'])->name('request.wig.storeRequest');
});

// Debug route (hapus di production)
Route::get('/debug/profile', function () {
    if (auth()->check()) {
        $user = auth()->user();
        return response()->json([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'profile_image' => $user->profile_image,
            'profile_image_url' => $user->profile_image ? asset('storage/' . $user->profile_image) : null,
            'updated_at' => $user->updated_at,
        ]);
    }
    return response()->json(['error' => 'Not authenticated']);
})->middleware('auth');
