<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;

class AdminProductosController extends Controller
{
    public function index() {
        $productos = Productos::all();
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
        return redirect()->route('productos.index')->with('success', 'Producto creado');
    }

    public function edit($id) {
        $producto = Productos::find($id);
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, $id) {
        $prod = Productos::find($id);
        
        $prod->nombre = $request->nombre;
        $prod->descripcion = $request->descripcion;
        $prod->precio = $request->precio;
        $prod->stock = $request->stock;

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagen'), $filename);
            $prod->imagen = 'imagen/' . $filename;
        }

        $prod->save();
        return redirect()->route('productos.index')->with('success', 'Producto actualizado');
    }

    public function destroy($id) {
        $prod = Productos::find($id);
        $prod->delete();
        return back()->with('success', 'Producto eliminado');
    }
}