<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
// 1. Importamos el controlador base de Laravel
use Illuminate\Routing\Controller as BaseController;

// 2. Heredamos de "BaseController"
class ExamenJoelController extends BaseController
{
    /**
     * Muestra el reporte de todos los animales.
     */
    public function reporteAnimales()
    {
        $animales = DB::table('animales as a')
            ->join('especies as e', 'a.id_especie', '=', 'e.id')
            ->select(
                'a.id', 
                'a.nombre AS nombre_animal',
                'e.nombre AS nombre_especie',
                'a.foto'
            )
            ->orderBy('a.nombre', 'asc')
            ->get();

        return view('Examen.reportejoel')->with('animales', $animales);
    }

    /**
     * Lógica para eliminar un animal.
     */
    public function eliminaAnimal(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:animales,id'
        ]);
        
        DB::table('animales')->where('id', $request->id)->delete();

        Session::flash('mensaje_animal', "El animal ha sido eliminado exitosamente.");
        return redirect()->route('reporteAnimales');
    }
}