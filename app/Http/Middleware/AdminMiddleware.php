<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();
        if (!($user && (property_exists($user, 'is_admin') || isset($user->is_admin)) && (bool)($user->is_admin ?? false))) {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors(['email' => 'Unauthorized access.']);
        }

        return $next($request);
    }
}