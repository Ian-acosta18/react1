<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Categoria;
use Session;
use File; // Importante para poder borrar archivos

class AdminServiciosController extends Controller
{
    // 1. REPORTE (CONSULTA)
    public function reporte()
    {
        // USO DE ELOQUENT: Es más limpio y trae la relación con categoría automáticamente
        // Asegúrate de tener la función 'categoria()' en tu modelo Servicio
        $servicios = Servicio::with('categoria')
                             ->orderBy('nombre_servicio', 'ASC')
                             ->get();

        return view('admin.servicios.reporte')->with('servicios', $servicios);
    }

    // 2. ALTA (VISTA)
    public function alta()
    {
        // Obtenemos categorías con Eloquent
        $categorias = Categoria::orderBy('nombre_categoria', 'ASC')->get();
        
        return view('admin.servicios.alta')->with('categorias', $categorias);
    }

    // 3. GUARDAR (ACCION)
    public function guardar(Request $request)
    {
        $this->validate($request, [
            'nombre_servicio' => 'required',
            'precio'          => 'required|numeric',
            'categoria_id'    => 'required',
            'foto'            => 'image|mimes:jpg,jpeg,png' // Validación de imagen
        ]);

        $ruta_imagen = ''; // Valor por defecto

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Generar nombre único: servicio_timestamp.ext
            $img = 'servicio_' . time() . '.' . $file->getClientOriginalExtension();
            // Mover a public/imagen
            $file->move(public_path('imagen'), $img);
            $ruta_imagen = 'imagen/' . $img;
        }

        $servicio = new Servicio;
        $servicio->nombre_servicio = $request->nombre_servicio;
        $servicio->precio          = $request->precio;
        $servicio->categoria_id    = $request->categoria_id;
        $servicio->imagen          = $ruta_imagen;
        
        $servicio->save();

        Session::flash('mensaje', "El servicio $request->nombre_servicio ha sido creado.");
        return redirect()->route('admin.servicios.reporte');
    }

    // 4. EDITAR (VISTA)
    public function editar($id)
    {
        // Buscamos con Eloquent. Si no existe, findOrFail o comprobación manual.
        $servicio = Servicio::find($id);
        $categorias = Categoria::orderBy('nombre_categoria', 'ASC')->get();

        if (!$servicio) {
            Session::flash('mensaje', "El servicio no existe.");
            return redirect()->route('admin.servicios.reporte');
        }

        return view('admin.servicios.edit')
            ->with('servicio', $servicio)
            ->with('categorias', $categorias);
    }

    // 5. ACTUALIZAR (ACCION)
    public function actualizar(Request $request)
    {
        // 1. Validamos
        $this->validate($request, [
            'id'              => 'required',
            'nombre_servicio' => 'required',
            'precio'          => 'required|numeric',
            'categoria_id'    => 'required',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png' // 'nullable' porque la foto es opcional al editar
        ]);

        // 2. Buscamos el servicio
        $servicio = Servicio::find($request->id);
        
        if (!$servicio) {
            return redirect()->route('admin.servicios.reporte');
        }

        // 3. ¿Subieron nueva foto?
        if ($request->hasFile('foto')) {
            // A) BORRAR FOTO ANTERIOR SI EXISTE
            // Verificamos que tenga una imagen guardada y que el archivo físico exista
            if ($servicio->imagen && File::exists(public_path($servicio->imagen))) {
                File::delete(public_path($servicio->imagen));
            }

            // B) SUBIR NUEVA FOTO
            $file = $request->file('foto');
            $img = 'servicio_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('imagen'), $img);
            
            // Actualizamos la propiedad en el objeto
            $servicio->imagen = 'imagen/' . $img; 
        }
        // Nota: Si no suben foto, no hacemos nada y se mantiene la ruta anterior.

        // 4. Actualizamos resto de campos
        $servicio->nombre_servicio = $request->nombre_servicio;
        $servicio->precio          = $request->precio;
        $servicio->categoria_id    = $request->categoria_id;
        
        // 5. Guardamos cambios
        $servicio->save();

        Session::flash('mensaje', "El servicio ha sido actualizado correctamente.");
        return redirect()->route('admin.servicios.reporte');
    }

    // 6. ELIMINAR (ACCION)
    public function eliminar($id)
    {
        // Buscamos primero para obtener la info de la imagen
        $servicio = Servicio::find($id);

        if ($servicio) {
            // 1. Borrar imagen del servidor si existe
            if ($servicio->imagen && File::exists(public_path($servicio->imagen))) {
                File::delete(public_path($servicio->imagen));
            }

            // 2. Eliminar registro de BD
            $servicio->delete();
            Session::flash('mensaje', "Servicio eliminado correctamente.");
        } else {
            Session::flash('mensaje', "No se pudo encontrar el servicio a eliminar.");
        }
        
        return redirect()->route('admin.servicios.reporte');
    }
}