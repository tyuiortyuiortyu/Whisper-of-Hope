<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
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
            return redirect()->route('admin.login');
        }

        // Check if user has admin role
        if (Auth::user()->role !== 'admin') {
            // If user role, redirect to user area
            if (Auth::user()->role === 'user') {
                return redirect()->route('welcome');
            }
            
            // Otherwise, show access denied
            abort(403, 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
