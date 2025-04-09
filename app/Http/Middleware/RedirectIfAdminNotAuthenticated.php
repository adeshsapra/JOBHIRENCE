<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdminNotAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // If the admin is logged in, prevent access to login & register pages
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
        }

        return $next($request);
    }
}