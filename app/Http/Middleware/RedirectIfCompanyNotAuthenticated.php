<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfCompanyNotAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // If the company is logged in, prevent access to login & register pages
        if (Auth::guard('company')->check()) {
            return redirect()->route('company.dashboard'); // Redirect to company dashboard
        }

        return $next($request);
    }
}
