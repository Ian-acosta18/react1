<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instalaciones; // Usamos TU modelo nuevo de Instalaciones
use Illuminate\Support\Facades\Session; // Importante para los mensajes flash
use Illuminate\Support\Facades\File;    // Importante para borrar imágenes

class AdminInstalacionesController extends Controller
{
    // 1. REPORTE (Listado)
    public function reporte()
    {
        // Usamos el scope 'ordenadas' de tu modelo para que salgan en orden
        $instalaciones = Instalaciones::ordenadas()->get();
        return view('admin.instalaciones.reporte')->with('instalaciones', $instalaciones);
    }

    // 2. ALTA (Vista Formulario)
    public function alta()
    {
        return view('admin.instalaciones.alta');
    }

    // 3. GUARDAR (Acción de crear en BD)
    public function guardar(Request $request)
    {
        $this->validate($request, [
            'titulo'      => 'required',
            'descripcion' => 'required',
            'orden'       => 'required|integer',
            'foto'        => 'required|image|mimes:jpg,jpeg,png' // Foto obligatoria al crear
        ]);

        $ruta_imagen = '';

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Generamos nombre único
            $img = 'instalacion_' . time() . '.' . $file->getClientOriginalExtension();
            // Movemos a la carpeta pública
            $file->move(public_path('imagen'), $img);
            $ruta_imagen = 'imagen/' . $img;
        }

        $instalacion = new Instalaciones;
        $instalacion->titulo      = $request->titulo;
        $instalacion->descripcion = $request->descripcion;
        $instalacion->orden       = $request->orden;
        // El checkbox a veces no envía nada si no se marca, por eso validamos
        $instalacion->activo      = $request->activo ? 1 : 0; 
        $instalacion->imagen      = $ruta_imagen;
        
        $instalacion->save();

        Session::flash('mensaje', "La instalación $request->titulo ha sido creada.");
        return redirect()->route('admin.instalaciones.reporte');
    }

    // 4. EDITAR (Vista Formulario)
    public function editar($id)
    {
        $instalacion = Instalaciones::find($id);

        if (!$instalacion) {
            Session::flash('mensaje', "La instalación no existe.");
            return redirect()->route('admin.instalaciones.reporte');
        }

        // CAMBIO AQUÍ: Apuntamos a 'admin.instalaciones.editar'
        return view('admin.instalaciones.editar')->with('instalacion', $instalacion);
    }

    // 5. ACTUALIZAR (Acción de guardar cambios)
    public function actualizar(Request $request)
    {
        $this->validate($request, [
            'id'          => 'required',
            'titulo'      => 'required',
            'descripcion' => 'required',
            'orden'       => 'required|integer',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png' // Foto opcional al editar
        ]);

        $instalacion = Instalaciones::find($request->id);
        
        if (!$instalacion) {
            return redirect()->route('admin.instalaciones.reporte');
        }

        // Manejo de foto (Igual que en Servicios)
        if ($request->hasFile('foto')) {
            // Borramos la anterior si existe
            if ($instalacion->imagen && File::exists(public_path($instalacion->imagen))) {
                File::delete(public_path($instalacion->imagen));
            }

            // Subimos la nueva
            $file = $request->file('foto');
            $img = 'instalacion_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('imagen'), $img);
            $instalacion->imagen = 'imagen/' . $img;
        }

        $instalacion->titulo      = $request->titulo;
        $instalacion->descripcion = $request->descripcion;
        $instalacion->orden       = $request->orden;
        $instalacion->activo      = $request->activo;
        
        $instalacion->save();

        Session::flash('mensaje', "Instalación actualizada correctamente.");
        return redirect()->route('admin.instalaciones.reporte');
    }

    // 6. ELIMINAR (Acción)
    public function eliminar($id)
    {
        $instalacion = Instalaciones::find($id);

        if ($instalacion) {
            // Borrar imagen física
            if ($instalacion->imagen && File::exists(public_path($instalacion->imagen))) {
                File::delete(public_path($instalacion->imagen));
            }
            $instalacion->delete();
            Session::flash('mensaje', "Instalación eliminada.");
        }
        
        return redirect()->route('admin.instalaciones.reporte');
    }
}