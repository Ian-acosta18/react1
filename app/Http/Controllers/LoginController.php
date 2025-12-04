<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Muestra el formulario de login
    public function showLoginForm()
    {
        // Si ya está logueado, lo mandamos a inicio
        if (Auth::check()) {
            return redirect()->route('inicio');
        }
        return view('login');
    }

    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        // 1. Validamos que los campos no estén vacíos
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Intentamos loguear (Auth::attempt encripta y compara automáticamente)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirige a la página que intentó visitar o a 'inicio' por defecto
            return redirect()->intended('inicio');
        }

        // 3. Si falla, regresa con error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}