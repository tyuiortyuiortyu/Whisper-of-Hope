<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if user has user role
        if (Auth::user()->role !== 'user') {
            // If admin role, redirect to admin area
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.user_admin');
            }
            
            // Otherwise, show access denied
            abort(403, 'Access denied. User privileges required.');
        }

        return $next($request);
    }
}
