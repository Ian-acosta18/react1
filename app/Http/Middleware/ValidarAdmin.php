<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class ValidarAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Si NO existe la sesión del admin, lo manda al login
        if (!Session::has('admin_session')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}