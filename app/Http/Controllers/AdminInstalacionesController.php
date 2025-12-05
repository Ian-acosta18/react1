<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instalaciones;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class AdminInstalacionesController extends Controller
{
    // 1. REPORTE
    public function reporte()
    {
        $instalaciones = Instalaciones::ordenadas()->get();
        return view('admin.instalaciones.reporte')->with('instalaciones', $instalaciones);
    }

    // 2. ALTA
    public function alta()
    {
        return view('admin.instalaciones.alta');
    }

    // 3. GUARDAR (CON VALIDACIÓN ESTRICTA)
    public function guardar(Request $request)
    {
        // Reglas de validación
        $reglas = [
            // Título: Requerido, mín 4 letras, máx 60. 
            // Regex: Solo permite letras (incluyendo tildes y ñ) y espacios. NO permite números solos.
            'titulo'      => ['required', 'string', 'min:4', 'max:60', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'], 
            
            // Descripción: Requerido, mín 10 letras (para que escriban algo real).
            'descripcion' => 'required|string|min:10|max:500',
            
            // Orden: Solo números enteros positivos (0 a 100).
            'orden'       => 'required|integer|min:0|max:100',
            
            // Foto: Obligatoria, debe ser imagen, máx 3MB.
            'foto'        => 'required|image|mimes:jpg,jpeg,png|max:3072' 
        ];

        // Mensajes de error personalizados en español
        $mensajes = [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.min'      => 'El título es muy corto (mínimo 4 letras).',
            'titulo.regex'    => 'El título solo puede contener letras y espacios (no números ni símbolos).',
            'descripcion.min' => 'La descripción debe ser más detallada (mínimo 10 caracteres).',
            'orden.integer'   => 'El orden debe ser un número entero.',
            'foto.required'   => 'Debes subir una imagen para la instalación.',
            'foto.image'      => 'El archivo debe ser una imagen válida (JPG, PNG).',
            'foto.max'        => 'La imagen pesa mucho (máximo 3MB).'
        ];

        $this->validate($request, $reglas, $mensajes);

        // --- Lógica de Guardado ---
        $ruta_imagen = '';
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $img = 'instalacion_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('imagen'), $img);
            $ruta_imagen = 'imagen/' . $img;
        }

        $instalacion = new Instalaciones;
        $instalacion->titulo      = $request->titulo;
        $instalacion->descripcion = $request->descripcion;
        $instalacion->orden       = $request->orden;
        $instalacion->activo      = $request->activo ? 1 : 0; 
        $instalacion->imagen      = $ruta_imagen;
        
        $instalacion->save();

        Session::flash('mensaje', "La instalación '$request->titulo' ha sido creada correctamente.");
        return redirect()->route('admin.instalaciones.reporte');
    }

    // 4. EDITAR
    public function editar($id)
    {
        $instalacion = Instalaciones::find($id);

        if (!$instalacion) {
            Session::flash('mensaje', "La instalación no existe.");
            return redirect()->route('admin.instalaciones.reporte');
        }

        return view('admin.instalaciones.editar')->with('instalacion', $instalacion);
    }

    // 5. ACTUALIZAR (CON VALIDACIÓN ESTRICTA)
    public function actualizar(Request $request)
    {
        // Reglas (Iguales a guardar, pero foto es opcional)
        $reglas = [
            'id'          => 'required',
            'titulo'      => ['required', 'string', 'min:4', 'max:60', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'],
            'descripcion' => 'required|string|min:10|max:500',
            'orden'       => 'required|integer|min:0|max:100',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:3072'
        ];

        $mensajes = [
            'titulo.regex'    => 'El título solo puede contener letras y espacios.',
            'titulo.min'      => 'El título es muy corto.',
            'descripcion.min' => 'La descripción es muy corta.',
            'foto.image'      => 'El archivo debe ser una imagen válida.'
        ];

        $this->validate($request, $reglas, $mensajes);

        $instalacion = Instalaciones::find($request->id);
        
        if (!$instalacion) {
            return redirect()->route('admin.instalaciones.reporte');
        }

        // Gestión de Imagen
        if ($request->hasFile('foto')) {
            if ($instalacion->imagen && File::exists(public_path($instalacion->imagen))) {
                File::delete(public_path($instalacion->imagen));
            }

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

    // 6. ELIMINAR
    public function eliminar($id)
    {
        $instalacion = Instalaciones::find($id);

        if ($instalacion) {
            if ($instalacion->imagen && File::exists(public_path($instalacion->imagen))) {
                File::delete(public_path($instalacion->imagen));
            }
            $instalacion->delete();
            Session::flash('mensaje', "Instalación eliminada.");
        }
        
        return redirect()->route('admin.instalaciones.reporte');
    }
}