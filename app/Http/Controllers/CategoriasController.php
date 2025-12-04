<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorias; // Asegúrate de crear el modelo abajo
use Session;

class CategoriasController extends Controller
{
    public function reportecategorias(){
        // Selección simple de todas las categorías
        $categorias = \DB::select("SELECT id_categoria, nombre_categoria 
                                   FROM categorias 
                                   ORDER BY nombre_categoria ASC");
        
        return view ('categorias.reporte')->with('categorias', $categorias);
    }

    public function altacategoria(){
        // Lógica para calcular el siguiente ID manualmente como en tu ejemplo
        $consulta = \DB::select("SELECT id_categoria FROM categorias ORDER BY id_categoria DESC LIMIT 1");
        
        $idsigue = count($consulta) > 0 ? $consulta[0]->id_categoria + 1 : 1;
        
        return view ('categorias.alta')->with('idsigue', $idsigue);
    }           

    public function guardacategoria(Request $request)
    {
        $this->validate($request, [
            'id_categoria' => 'required|integer',
            'nombre_categoria' => 'required|regex:/^[A-Z,a-z, ,é,ó,ñ,Á,Ó]+$/',
        ]);

        $categoria = new categorias;
        $categoria->id_categoria = $request->id_categoria;
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->save();

        Session::flash('mensaje', "La categoría $request->nombre_categoria ha sido dada de alta");
        return redirect()->route('reportecategorias');
    }

    public function eliminacategoria(Request $request){
        $categoria = \DB::update("DELETE FROM categorias WHERE id_categoria = $request->id_categoria");

        Session::flash('mensaje', "La categoría ha sido eliminada");
        return redirect()->route('reportecategorias');
    }

    public function editacategoria(Request $request){
        $infocategoria = \DB::select("SELECT id_categoria, nombre_categoria 
                                      FROM categorias 
                                      WHERE id_categoria = $request->id_categoria");

        return view ('categorias.edita')
                ->with('infocategoria', $infocategoria[0]);
    }

    public function actualizacategoria(Request $request)
    {
        $this->validate($request, [
            'id_categoria' => 'required|integer',
            'nombre_categoria' => 'required|regex:/^[A-Z,a-z, ,é,ó,ñ,Á,Ó]+$/',
        ]);

        $categoria = categorias::find($request->id_categoria);
        $categoria->id_categoria = $request->id_categoria;
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->save();

        Session::flash('mensaje', "La categoría $request->nombre_categoria ha sido actualizada");
        return redirect()->route('reportecategorias');
    }
}