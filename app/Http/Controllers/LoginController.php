<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // USAR ESTA IMPORTACIÓN
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $correo = $request->input('correo');
        $password = $request->input('password');

        // Consulta manual
        $usuario = DB::select("SELECT * FROM usuarios WHERE correo = ? AND password = ? AND activo = 'Si'", [$correo, $password]);

        if (!empty($usuario)) {
            // 1. Guardamos datos en sesión
            Session::put('admin_session', $usuario[0]->nombre);
            Session::put('id_usuario', $usuario[0]->id_usuario);
            
            // 2. IMPORTANTE: Forzar el guardado de la sesión
            Session::save();
            
            // 3. Redirigir al dashboard
            return redirect()->route('admin.dashboard');
        } else {
            Session::flash('error', 'Credenciales incorrectas o usuario inactivo');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Session::forget('admin_session');
        Session::forget('id_usuario');
        Session::save(); // Guardar el cambio al salir
        return redirect()->route('inicio');
    }
}