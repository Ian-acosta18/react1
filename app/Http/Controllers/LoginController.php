<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function showLoginForm() {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'correo'   => 'required|email', // Validamos el campo 'correo'
            'password' => 'required'
        ]);

        
        $credenciales = [
            'correo'   => $request->correo,
            'password' => $request->password,
            
        ];

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            // Usamos 'nombre' en lugar de 'name'
            Session::put('admin_nombre', Auth::user()->nombre); 
            return redirect()->route('admin.dashboard');
        }

        return back()->with('mensaje', 'Credenciales incorrectas o usuario no encontrado.');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('inicio');
    }
}