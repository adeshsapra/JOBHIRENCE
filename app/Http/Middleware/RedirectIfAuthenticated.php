<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        // If user is logged in, redirect to the profile page
        if (Auth::check()) {
            return redirect()->route('account.userProfile');
        }

        return $next($request);
    }
}
