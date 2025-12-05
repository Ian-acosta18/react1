<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use Illuminate\Support\Facades\File; // Importación correcta

class AdminProductosController extends Controller
{
    // 1. REPORTE
    public function reporte() {
        $productos = Productos::all();
        // Asegúrate de que tu vista esté en resources/views/admin/productos/reporte.blade.php
        // Si tu archivo se llama 'index.blade.php', cámbialo aquí a 'admin.productos.index'
        return view('admin.productos.reporte', compact('productos'));
    }

    // 2. ALTA
    public function alta() {
        return view('admin.productos.create');
    }

    // 3. GUARDAR
    public function guardar(Request $request) {
        // Validaciones
        $reglas = [
            'nombre'      => 'required|string|max:100|unique:productos,nombre|not_regex:/^[0-9]+$/', 
            'descripcion' => 'nullable|string|max:500|not_regex:/^[0-9]+$/',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'nullable|integer|min:0',
            'imagen'      => 'required|image|mimes:jpeg,png,jpg|max:2048' // Imagen obligatoria al crear
        ];

        $mensajes = [
            'nombre.not_regex' => 'El nombre no puede ser solo números.',
            'imagen.required'  => 'La imagen es obligatoria.',
            'imagen.image'     => 'El archivo debe ser una imagen válida (jpg, png).',
            'imagen.max'       => 'La imagen no puede pesar más de 2MB.'
        ];

        $request->validate($reglas, $mensajes);

        $prod = new Productos();
        $prod->nombre = $request->nombre;
        $prod->descripcion = $request->descripcion;
        $prod->precio = $request->precio;
        $prod->stock = $request->stock ?? 0;

        // Subida de Imagen
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Mover a public/imagen
            $file->move(public_path('imagen'), $filename);
            $prod->imagen = 'imagen/' . $filename;
        }

        $prod->save();
        
        return redirect()->route('admin.productos.reporte')->with('mensaje', 'Producto creado exitosamente');
    }

    // 4. EDITAR
    public function editar($id) {
        $producto = Productos::find($id);
        if (!$producto) {
            return redirect()->route('admin.productos.reporte');
        }
        return view('admin.productos.edit', compact('producto'));
    }

    // 5. ACTUALIZAR
    public function actualizar(Request $request) {
        // Buscamos por el ID que viene oculto en el formulario
        $prod = Productos::find($request->id);

        if (!$prod) {
            return redirect()->route('admin.productos.reporte');
        }

        $reglas = [
            'nombre'      => 'required|string|max:100|not_regex:/^[0-9]+$/',
            'descripcion' => 'nullable|string|max:500|not_regex:/^[0-9]+$/',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'nullable|integer|min:0',
            'imagen'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Opcional al editar
        ];

        $request->validate($reglas);

        // Lógica de Imagen
        if ($request->hasFile('imagen')) {
            // Borrar anterior si existe
            if ($prod->imagen && File::exists(public_path($prod->imagen))) {
                File::delete(public_path($prod->imagen));
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

        return redirect()->route('admin.productos.reporte')->with('mensaje', 'Producto actualizado exitosamente');
    }

    // 6. ELIMINAR
    public function eliminar($id) {
        $prod = Productos::find($id);
        
        if ($prod) {
            if ($prod->imagen && File::exists(public_path($prod->imagen))) {
                File::delete(public_path($prod->imagen));
            }
            $prod->delete();
        }
        
        return redirect()->route('admin.productos.reporte')->with('mensaje', 'Producto eliminado');
    }
}