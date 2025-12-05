<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Categoria;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class AdminServiciosController extends Controller
{
    // 1. REPORTE
    public function reporte()
    {
        $servicios = Servicio::with('categoria')
                             ->orderBy('nombre_servicio', 'ASC')
                             ->get();

        return view('admin.servicios.reporte')->with('servicios', $servicios);
    }

    // 2. ALTA
    public function alta()
    {
        $categorias = Categoria::orderBy('nombre_categoria', 'ASC')->get();
        return view('admin.servicios.alta')->with('categorias', $categorias);
    }

    // 3. GUARDAR
    public function guardar(Request $request)
    {
        $reglas = [
            'nombre_servicio' => 'required|string|min:4|max:60|not_regex:/^[0-9]+$/',
            'precio'          => 'required|numeric|min:0',
            'categoria_id'    => 'required',
            'activo'          => 'required|boolean', // <--- VALIDACIÓN NUEVA
            'foto'            => 'required|image|mimes:jpg,jpeg,png|max:2048' 
        ];

        $mensajes = [
            'nombre_servicio.not_regex' => 'El nombre no puede ser solo números.',
            'foto.required'             => 'La imagen es obligatoria.',
            'foto.max'                  => 'La imagen pesa mucho (máximo 2MB).'
        ];

        $this->validate($request, $reglas, $mensajes);

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
        $servicio->activo          = $request->activo; // <--- GUARDAR ESTADO
        $servicio->imagen          = $ruta_imagen;
        
        $servicio->save();

        Session::flash('mensaje', "Servicio creado correctamente.");
        return redirect()->route('admin.servicios.reporte');
    }

    // 4. EDITAR
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

    // 5. ACTUALIZAR
    public function actualizar(Request $request)
    {
        $reglas = [
            'id'              => 'required',
            'nombre_servicio' => 'required|string|min:4|max:60|not_regex:/^[0-9]+$/',
            'precio'          => 'required|numeric|min:0',
            'categoria_id'    => 'required',
            'activo'          => 'required|boolean', // <--- VALIDACIÓN NUEVA
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ];

        $this->validate($request, $reglas);

        $servicio = Servicio::find($request->id);
        
        if (!$servicio) {
            return redirect()->route('admin.servicios.reporte');
        }

        if ($request->hasFile('foto')) {
            if ($servicio->imagen && File::exists(public_path($servicio->imagen))) {
                File::delete(public_path($servicio->imagen));
            }
            $file = $request->file('foto');
            $img = 'servicio_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('imagen'), $img);
            $servicio->imagen = 'imagen/' . $img; 
        }

        $servicio->nombre_servicio = $request->nombre_servicio;
        $servicio->precio          = $request->precio;
        $servicio->categoria_id    = $request->categoria_id;
        $servicio->activo          = $request->activo; // <--- ACTUALIZAR ESTADO
        
        $servicio->save();

        Session::flash('mensaje', "Servicio actualizado correctamente.");
        return redirect()->route('admin.servicios.reporte');
    }

    // 6. ELIMINAR
    public function eliminar($id)
    {
        $servicio = Servicio::find($id);
        if ($servicio) {
            if ($servicio->imagen && File::exists(public_path($servicio->imagen))) {
                File::delete(public_path($servicio->imagen));
            }
            $servicio->delete();
            Session::flash('mensaje', "Servicio eliminado.");
        }
        return redirect()->route('admin.servicios.reporte');
    }
}