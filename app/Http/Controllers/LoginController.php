<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Importante
use Illuminate\Support\Facades\DB;      // Importante

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Si ya estamos logueados, no mostrar el login, mandar directo al menú
        if (Session::has('admin_session')) {
            return redirect()->route('admin.dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $correo = $request->input('correo');
        $password = $request->input('password');

        // Buscamos al usuario en la BD (contraseña texto plano según tu SQL)
        $usuario = DB::select("SELECT * FROM usuarios WHERE correo = ? AND password = ? AND activo = 'Si'", [$correo, $password]);

        if (!empty($usuario)) {
            // 1. Guardar datos en sesión
            Session::put('admin_session', $usuario[0]->nombre);
            Session::put('id_usuario', $usuario[0]->id_usuario);
            
            // 2. ¡OBLIGATORIO! Forzar el guardado inmediato
            Session::save();
            
            // 3. Redirigir al Menú (Dashboard)
            return redirect()->route('admin.dashboard');
        } else {
            // Error: credenciales malas
            return back()->with('error', 'Correo o contraseña incorrectos, o usuario inactivo.');
        }
    }

    public function logout()
    {
        Session::forget('admin_session');
        Session::forget('id_usuario');
        Session::save(); 
        return redirect()->route('login');
    }
}