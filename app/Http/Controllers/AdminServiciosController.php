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
        // Join para traer el nombre de la categoría
        $servicios = DB::select("
            SELECT s.id, s.nombre_servicio, s.precio, s.iamgen, c.nombre_categoria 
            FROM servicios AS s 
            INNER JOIN categorias AS c ON s.categoria_id = c.id 
            ORDER BY s.nombre_servicio ASC
        ");

        return view('admin.servicios.reporte')->with('servicios', $servicios);
    }

    // 2. ALTA (VISTA)
    public function alta()
    {
        // Obtenemos categorías para el select
        $categorias = DB::select("SELECT * FROM categorias ORDER BY nombre_categoria ASC");
        
        // Calculamos el siguiente ID para renombrar la foto (estilo proyaplicweb)
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

        // Manejo de imagen similar a tu referencia
        $file = $request->file('foto');
        $img = '';
        
        if ($file) {
            // Usamos time() para evitar caché o conflictos
            $img = 'servicio_' . time() . '.' . $file->getClientOriginalExtension();
            // Guardar en public/imagen/ (según tu estructura de carpetas)
            $file->move(public_path('imagen'), $img);
            $ruta_imagen = 'imagen/' . $img;
        } else {
            $ruta_imagen = 'imagen/sinfoto.jpg'; // Asegúrate de tener esta imagen
        }

        // Insertar
        $servicio = new Servicio;
        $servicio->nombre_servicio = $request->nombre_servicio;
        $servicio->precio = $request->precio;
        $servicio->categoria_id = $request->categoria_id;
        $servicio->iamgen = $ruta_imagen; // Nota: campo 'iamgen' de tu DB
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

        return view('admin.servicios.edita')
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
        
        // Manejo de nueva foto
        $file = $request->file('foto');
        if ($file) {
            $img = 'servicio_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('imagen'), $img);
            $servicio->iamgen = 'imagen/' . $img; // Actualizamos la ruta
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
        // Borrado físico como en tu referencia "eliminaempleado"
        DB::delete("DELETE FROM servicios WHERE id = ?", [$id]);
        
        Session::flash('mensaje', "Servicio eliminado correctamente.");
        return redirect()->route('admin.servicios.reporte');
    }
}