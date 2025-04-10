<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAdminAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the admin is not authenticated
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login'); // Redirect to admin login page
        }

        return $next($request);
    }
}
