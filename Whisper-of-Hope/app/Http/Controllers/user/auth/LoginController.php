<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm() { 
        return view('welcome'); 
    }

    /**
     * Handle login request
     */
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email', 
            'password' => 'required'
        ]);
        
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $user = Auth::user();
            
            // Check if user is admin - prevent admin login through user page
            if ($user->role === 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Admin accounts must use the admin login page.',
                ])->withInput($request->only('email'));
            }
            
            // Only allow regular users
            if ($user->role !== 'user') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Invalid user role.',
                ])->withInput($request->only('email'));
            }
            
            $request->session()->regenerate();
            return redirect()->intended(route('welcome'));
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->withInput($request->only('email'));
    }

    /**
     * Logout
     */
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}