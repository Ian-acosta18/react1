<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Categoria;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class AdminServiciosController extends Controller
{
    // 1. REPORTE (CONSULTA)
    public function reporte()
    {
        $servicios = Servicio::with('categoria')
                             ->orderBy('nombre_servicio', 'ASC')
                             ->get();

        return view('admin.servicios.reporte')->with('servicios', $servicios);
    }

    // 2. ALTA (VISTA)
    public function alta()
    {
        $categorias = Categoria::orderBy('nombre_categoria', 'ASC')->get();
        return view('admin.servicios.alta')->with('categorias', $categorias);
    }

    // 3. GUARDAR (ACCION CON VALIDACIÓN ESTRICTA)
    public function guardar(Request $request)
    {
        // --- REGLAS DE VALIDACIÓN ---
        $reglas = [
            // Nombre: Mínimo 4 letras, solo letras y espacios.
            'nombre_servicio' => ['required', 'string', 'min:4', 'max:60', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'],
            
            // Precio: Obligatorio, numérico, positivo y menor a 10,000 (ajústalo si vendes cosas más caras).
            'precio'          => 'required|numeric|min:0|max:10000',
            
            // Categoría: Obligatoria.
            'categoria_id'    => 'required|integer',
            
            // Foto: Obligatoria al crear, imagen válida, máx 3MB.
            'foto'            => 'required|image|mimes:jpg,jpeg,png|max:3072'
        ];

        // --- MENSAJES PERSONALIZADOS ---
        $mensajes = [
            'nombre_servicio.required' => 'El nombre del servicio es obligatorio.',
            'nombre_servicio.min'      => 'El nombre es muy corto (mínimo 4 letras).',
            'nombre_servicio.regex'    => 'El nombre solo puede contener letras y espacios.',
            'precio.required'          => 'Debes asignar un precio.',
            'precio.numeric'           => 'El precio debe ser un número válido.',
            'precio.min'               => 'El precio no puede ser negativo.',
            'categoria_id.required'    => 'Debes seleccionar una categoría.',
            'foto.required'            => 'La imagen del servicio es obligatoria.',
            'foto.image'               => 'El archivo debe ser una imagen válida (JPG, PNG).',
            'foto.max'                 => 'La imagen es muy pesada (máximo 3MB).'
        ];

        $this->validate($request, $reglas, $mensajes);

        // --- PROCESO DE GUARDADO ---
        $ruta_imagen = ''; 

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $img = 'servicio_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('imagen'), $img);
            $ruta_imagen = 'imagen/' . $img;
        }

        $servicio = new Servicio;
        $servicio->nombre_servicio = $request->nombre_servicio;
        $servicio->precio          = $request->precio;
        $servicio->categoria_id    = $request->categoria_id;
        $servicio->imagen          = $ruta_imagen;
        
        $servicio->save();

        Session::flash('mensaje', "El servicio '$request->nombre_servicio' ha sido creado correctamente.");
        return redirect()->route('admin.servicios.reporte');
    }

    // 4. EDITAR (VISTA)
    public function editar($id)
    {
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

    // 5. ACTUALIZAR (ACCION CON VALIDACIÓN ESTRICTA)
    public function actualizar(Request $request)
    {
        // --- REGLAS (Iguales a guardar, pero foto opcional) ---
        $reglas = [
            'id'              => 'required',
            'nombre_servicio' => ['required', 'string', 'min:4', 'max:60', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'],
            'precio'          => 'required|numeric|min:0|max:10000',
            'categoria_id'    => 'required|integer',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png|max:3072'
        ];

        $mensajes = [
            'nombre_servicio.regex' => 'El nombre solo puede contener letras y espacios.',
            'precio.numeric'        => 'El precio debe ser un número válido.',
            'precio.min'            => 'El precio no puede ser negativo.'
        ];

        $this->validate($request, $reglas, $mensajes);

        $servicio = Servicio::find($request->id);
        
        if (!$servicio) {
            return redirect()->route('admin.servicios.reporte');
        }

        // --- GESTIÓN DE FOTO ---
        if ($request->hasFile('foto')) {
            // Borrar anterior
            if ($servicio->imagen && File::exists(public_path($servicio->imagen))) {
                File::delete(public_path($servicio->imagen));
            }

            // Subir nueva
            $file = $request->file('foto');
            $img = 'servicio_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('imagen'), $img);
            
            $servicio->imagen = 'imagen/' . $img; 
        }

        $servicio->nombre_servicio = $request->nombre_servicio;
        $servicio->precio          = $request->precio;
        $servicio->categoria_id    = $request->categoria_id;
        
        $servicio->save();

        Session::flash('mensaje', "Servicio actualizado correctamente.");
        return redirect()->route('admin.servicios.reporte');
    }

    // 6. ELIMINAR (ACCION)
    public function eliminar($id)
    {
        $servicio = Servicio::find($id);

        if ($servicio) {
            if ($servicio->imagen && File::exists(public_path($servicio->imagen))) {
                File::delete(public_path($servicio->imagen));
            }

            $servicio->delete();
            Session::flash('mensaje', "Servicio eliminado correctamente.");
        } else {
            Session::flash('mensaje', "No se pudo encontrar el servicio.");
        }
        
        return redirect()->route('admin.servicios.reporte');
    }
}