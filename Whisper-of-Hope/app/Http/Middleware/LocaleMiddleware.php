<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Use a more defensive approach for session access
            $locale = 'en'; // Default fallback
            
            if (Session::isStarted()) {
                $locale = Session::get('locale', config('app.locale', 'en'));
            } else {
                $locale = config('app.locale', 'en');
            }
            
            $supportedLocales = config('app.supported_locales', ['en', 'id']);
            
            if (is_array($supportedLocales) && in_array($locale, $supportedLocales)) {
                App::setLocale($locale);
            } else {
                // Fallback to default locale if supported_locales is not an array or locale is not supported
                App::setLocale(config('app.locale', 'en'));
            }
        } catch (\Exception $e) {
            // Fallback to default locale if anything goes wrong
            App::setLocale('en');
            Log::error('LocaleMiddleware error: ' . $e->getMessage());
        }
        
        return $next($request);
    }
}
