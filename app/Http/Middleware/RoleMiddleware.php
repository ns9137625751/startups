<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized.');
        }

        // Super admin bypasses all role restrictions
        if (Auth::user()->role === 'super_admin') {
            return $next($request);
        }

        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
