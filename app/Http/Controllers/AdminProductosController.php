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
        $reglas = [
            // not_regex:/^[0-9]+$/  -> Falla si el texto son solo números
            'nombre'      => 'required|string|max:100|unique:productos,nombre|not_regex:/^[0-9]+$/', 
            'descripcion' => 'nullable|string|max:500|not_regex:/^[0-9]+$/',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'nullable|integer|min:0',
            'imagen'      => 'required|image|mimes:jpeg,png,jpg|max:2048' // Max 2MB
        ];

        $mensajes = [
            'nombre.not_regex'      => 'El nombre no puede estar compuesto solo por números.',
            'descripcion.not_regex' => 'La descripción no puede ser solo números.',
            'imagen.required'       => 'La imagen es obligatoria al crear un producto.',
            'imagen.max'            => 'La imagen no puede pesar más de 2MB.',
            // ... otros mensajes personalizados ...
        ];

        $request->validate($reglas, $mensajes);

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

        $reglas = [
            'nombre'      => 'required|string|max:100|not_regex:/^[0-9]+$/',
            'descripcion' => 'nullable|string|max:500|not_regex:/^[0-9]+$/',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'nullable|integer|min:0',
            'imagen'      => 'nullable|image|mimes:jpeg,png,jpg' 
        ];

        $mensajes = [
            'nombre.not_regex'      => 'El nombre no puede estar compuesto solo por números.',
            'descripcion.not_regex' => 'La descripción no puede ser solo números.',
            'imagen.image'          => 'El archivo debe ser una imagen válida.',
            'imagen.max'            => 'La imagen no puede pesar más de 2MB.'
        ];

        $request->validate($reglas, $mensajes);

        // Lógica para mantener la imagen anterior si no se sube una nueva
        if ($request->hasFile('imagen')) {
            // Solo si suben una nueva, borramos la vieja
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