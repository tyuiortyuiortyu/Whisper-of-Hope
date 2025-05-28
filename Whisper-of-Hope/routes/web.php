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