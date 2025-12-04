<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Categoria;

class AdminServiciosController extends Controller
{
    public function index() {
        $servicios = Servicio::with('categoria')->get();
        return view('admin.servicios.index', compact('servicios'));
    }

    public function create() {
        $categorias = Categoria::all();
        return view('admin.servicios.create', compact('categorias'));
    }

    public function store(Request $request) {
    $request->validate([
        'nombre_servicio' => 'required',
        'categoria_id' => 'required',
        'precio' => 'required|numeric',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validación nueva
    ]);

    $servicio = new Servicio();
    $servicio->nombre_servicio = $request->nombre_servicio;
    $servicio->categoria_id = $request->categoria_id;
    $servicio->precio = $request->precio;

    // LÓGICA DE IMAGEN NUEVA
    if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        // Nombramos el archivo con tiempo para evitar duplicados
        $filename = time() . '_' . $file->getClientOriginalName();
        // Guardamos en la carpeta public/imagen
        $file->move(public_path('imagen'), $filename);
        $servicio->imagen = 'imagen/' . $filename;
    }

    $servicio->save();

    return redirect()->route('servicios.index');
    }

    public function edit($id) {
        $servicio = Servicio::find($id);
        $categorias = Categoria::all();
        return view('admin.servicios.edit', compact('servicio', 'categorias'));
    }

    public function update(Request $request, $id) {
        $servicio = Servicio::find($id);
        $servicio->nombre_servicio = $request->nombre_servicio;
        $servicio->categoria_id = $request->categoria_id;
        $servicio->precio = $request->precio;
        $servicio->save();

        return redirect()->route('servicios.index');
    }

    public function destroy($id) {
        $servicio = Servicio::find($id);
        $servicio->delete();
        return back();
    }
}