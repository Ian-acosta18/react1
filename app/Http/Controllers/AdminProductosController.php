<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;

class AdminProductosController extends Controller
{
    public function index() {
        // Obtenemos todos los productos
        $productos = Productos::all();
        // Asegúrate que tu vista exista en: resources/views/admin/productos/index.blade.php
        // Si tu vista se llama 'reporte.blade.php', cambia 'index' por 'reporte' abajo.
        return view('admin.productos.index', compact('productos'));
    }

    public function create() {
        return view('admin.productos.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'imagen' => 'required|image'
        ]);

        $prod = new Productos();
        $prod->nombre = $request->nombre;
        $prod->descripcion = $request->descripcion;
        $prod->precio = $request->precio;
        $prod->stock = $request->stock ?? 0;

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagen'), $filename);
            $prod->imagen = 'imagen/' . $filename;
        }

        $prod->save();
        
        // CORRECCIÓN: Redirigir a la ruta correcta definida en web.php
        return redirect()->route('admin.productos.reporte')->with('success', 'Producto creado');
    }

    public function edit($id) {
        $producto = Productos::find($id);
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, $id) {
        $prod = Productos::find($id);

        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image'
        ]);

        if ($request->hasFile('imagen')) {
            // Borrar imagen anterior si existe
            if ($prod->imagen && file_exists(public_path($prod->imagen))) {
                @unlink(public_path($prod->imagen));
            }

            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagen'), $filename);
            $prod->imagen = 'imagen/' . $filename;
        }
        
        $prod->nombre = $request->nombre;
        $prod->descripcion = $request->descripcion;
        $prod->precio = $request->precio;
        $prod->stock = $request->stock;

        $prod->save();

        // CORRECCIÓN: Redirigir a la ruta correcta definida en web.php
        return redirect()->route('admin.productos.reporte')->with('success', 'Producto actualizado');
    }

    public function destroy($id) {
        $prod = Productos::find($id);
        
        if ($prod) {
            // Borrar imagen del servidor
            if ($prod->imagen && file_exists(public_path($prod->imagen))) {
                @unlink(public_path($prod->imagen));
            }
            $prod->delete();
        }
        
        return back()->with('success', 'Producto eliminado');
    }
}