<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is authenticated, redirect based on role
        if (Auth::check()) {
            $user = Auth::user();
            
            // Only redirect admins if they're trying to access admin login page
            if ($user->role === 'admin' && $request->routeIs('admin.login')) {
                return redirect()->route('admin.user_admin');
            } 
            // Only redirect regular users from non-admin routes
            elseif ($user->role === 'user' && !$request->is('admin/*')) {
                return redirect()->route('welcome');
            }
        }

        return $next($request);
    }
}
