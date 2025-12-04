<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // USAR ESTA IMPORTACIÓN

class ValidarAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Si NO tiene sesión, redirige al login
        if (!Session::has('admin_session')) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}