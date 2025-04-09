<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    public function handle($request, Closure $next)
    {
        // If user is not logged in, redirect to the login page
        if (!Auth::check()) {
            return redirect()->route('account.userLogin');
        }

        return $next($request);
    }
}
