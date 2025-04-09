<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfCompanyAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the company is not authenticated
        if (!Auth::guard('company')->check()) {
            return redirect()->route('company.login'); // Redirect to company login page
        }

        return $next($request);
    }
}