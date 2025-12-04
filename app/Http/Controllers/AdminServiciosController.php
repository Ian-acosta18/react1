<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Categoria;
use Session;
use DB;
use Storage;
use File;

class AdminServiciosController extends Controller
{
    // 1. REPORTE (CONSULTA)
    public function reporte()
    {
        // CORREGIDO: s.imagen en lugar de s.iamgen
        $servicios = DB::select("
            SELECT s.id, s.nombre_servicio, s.precio, s.imagen, c.nombre_categoria 
            FROM servicios AS s 
            INNER JOIN categorias AS c ON s.categoria_id = c.id 
            ORDER BY s.nombre_servicio ASC
        ");

        return view('admin.servicios.reporte')->with('servicios', $servicios);
    }

    // 2. ALTA (VISTA)
    public function alta()
    {
        $categorias = DB::select("SELECT * FROM categorias ORDER BY nombre_categoria ASC");
        
        $ultimo = DB::select("SELECT id FROM servicios ORDER BY id DESC LIMIT 1");
        $idsigue = !empty($ultimo) ? $ultimo[0]->id + 1 : 1;

        return view('admin.servicios.alta')
            ->with('categorias', $categorias)
            ->with('idsigue', $idsigue);
    }

    // 3. GUARDAR (ACCION)
    public function guardar(Request $request)
    {
        $this->validate($request, [
            'nombre_servicio' => 'required',
            'precio' => 'required|numeric',
            'categoria_id' => 'required',
            'foto' => 'image|mimes:jpg,jpeg,png'
        ]);

        $file = $request->file('foto');
        $img = ''; // Variable inicial vacía
        
        if ($file) {
            $img = 'servicio_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('imagen'), $img);
            $ruta_imagen = 'imagen/' . $img;
        } else {
            // Si no suben foto, dejamos esto vacío o la ruta por defecto, 
            // pero es mejor dejarlo vacío y controlarlo en la vista con el @if
            $ruta_imagen = ''; 
        }

        $servicio = new Servicio;
        $servicio->nombre_servicio = $request->nombre_servicio;
        $servicio->precio = $request->precio;
        $servicio->categoria_id = $request->categoria_id;
        
        // CORREGIDO: propiedad imagen
        $servicio->imagen = $ruta_imagen; 
        
        $servicio->save();

        Session::flash('mensaje', "El servicio $request->nombre_servicio ha sido creado.");
        return redirect()->route('admin.servicios.reporte');
    }

    // 4. EDITAR (VISTA)
    public function editar($id)
    {
        $servicio = DB::select("SELECT * FROM servicios WHERE id = ?", [$id]);
        $categorias = DB::select("SELECT * FROM categorias ORDER BY nombre_categoria ASC");

        if (empty($servicio)) {
            return redirect()->route('admin.servicios.reporte');
        }

        return view('admin.servicios.edita') // Asegúrate de que tu vista se llame 'edita' o 'edit'
            ->with('servicio', $servicio[0])
            ->with('categorias', $categorias);
    }

    // 5. ACTUALIZAR (ACCION)
    public function actualizar(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'nombre_servicio' => 'required',
            'precio' => 'required|numeric',
            'categoria_id' => 'required'
        ]);

        $servicio = Servicio::find($request->id);
        
        $file = $request->file('foto');
        if ($file) {
            $img = 'servicio_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('imagen'), $img);
            
            // CORREGIDO: propiedad imagen
            $servicio->imagen = 'imagen/' . $img; 
        }

        $servicio->nombre_servicio = $request->nombre_servicio;
        $servicio->precio = $request->precio;
        $servicio->categoria_id = $request->categoria_id;
        $servicio->save();

        Session::flash('mensaje', "El servicio ha sido actualizado.");
        return redirect()->route('admin.servicios.reporte');
    }

    // 6. ELIMINAR (ACCION)
    public function eliminar($id)
    {
        DB::delete("DELETE FROM servicios WHERE id = ?", [$id]);
        
        Session::flash('mensaje', "Servicio eliminado correctamente.");
        return redirect()->route('admin.servicios.reporte');
    }
}