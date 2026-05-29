<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
          return redirect('/login');
        }

        if (strtolower(Auth::user()->role) !== strtolower($role)) {
          abort(403, 'Hanya Admin yang bisa masuk');
        }

        return $next($request);

    }
}
