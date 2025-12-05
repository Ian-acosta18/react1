<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use File; // Importante para borrar imágenes

class AdminProductosController extends Controller
{
    // 1. MOSTRAR LISTA (Igual que Servicios)
    public function index() {
        $productos = Productos::all();
        // CORRECCIÓN CLAVE: Cambiamos 'admin.productos.index' por 'admin.productos.reporte'
        // Esto cargará la vista que tiene el diseño de tabla idéntico a Servicios.
        return view('admin.productos.reporte', compact('productos'));
    }

    // 2. FORMULARIO DE ALTA
    public function create() {
        return view('admin.productos.alta'); // Asegúrate de que la vista se llame alta.blade.php
    }

    // 3. GUARDAR PRODUCTO
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
        
        // CORRECCIÓN REDIRECCIÓN: Te devuelve a la lista correcta
        return redirect()->route('admin.productos.reporte')->with('mensaje', 'Producto creado exitosamente');
    }

    // 4. FORMULARIO DE EDICIÓN
    public function edit($id) {
        $producto = Productos::find($id);
        return view('admin.productos.edit', compact('producto'));
    }

    // 5. ACTUALIZAR PRODUCTO
    public function update(Request $request, $id) {
        $prod = Productos::find($id);

        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image'
        ]);

        if ($request->hasFile('imagen')) {
            // Borrar imagen anterior
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

        // CORRECCIÓN REDIRECCIÓN
        return redirect()->route('admin.productos.reporte')->with('mensaje', 'Producto actualizado exitosamente');
    }

    // 6. ELIMINAR PRODUCTO
    public function destroy($id) {
        $prod = Productos::find($id);
        
        if ($prod) {
            if ($prod->imagen && file_exists(public_path($prod->imagen))) {
                @unlink(public_path($prod->imagen));
            }
            $prod->delete();
        }
        
        return redirect()->route('admin.productos.reporte')->with('mensaje', 'Producto eliminado');
    }
}