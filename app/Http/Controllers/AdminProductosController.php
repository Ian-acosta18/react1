<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\StockOpcion; // Si no lo usas, puedes borrar esta línea
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AdminProductosController extends Controller
{
    // 1. REPORTE (Antes index)
    public function reporte() {
        $productos = Productos::all();
        return view('admin.productos.reporte', compact('productos'));
    }

    // 2. ALTA (Antes create)
    public function alta() {
        // Array vacío si no usas stock predefinido
        $stock_opciones = collect([]); 
        return view('admin.productos.alta', compact('stock_opciones'));
    }

    // 3. GUARDAR (Antes store)
    public function guardar(Request $request) {
        $reglas = [
            'nombre'      => 'required|string|max:100|unique:productos,nombre|not_regex:/^[0-9]+$/', 
            'descripcion' => 'nullable|string|max:500|not_regex:/^[0-9]+$/',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'nullable|integer|min:0',
            'activo'      => 'required|boolean', // Validamos el campo activo
            'imagen'      => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];

        $mensajes = [
            'nombre.not_regex' => 'El nombre no puede ser solo números.',
            'imagen.required'  => 'La imagen es obligatoria.',
            'imagen.max'       => 'La imagen pesa mucho (máximo 2MB).'
        ];

        $request->validate($reglas, $mensajes);

        $prod = new Productos();
        $prod->nombre      = $request->nombre;
        $prod->descripcion = $request->descripcion;
        $prod->precio      = $request->precio;
        $prod->stock       = $request->stock ?? 0;
        $prod->activo      = $request->activo; // Guardamos el estado

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagen'), $filename);
            $prod->imagen = 'imagen/' . $filename;
        }

        $prod->save();
        
        Session::flash('mensaje', 'Producto creado exitosamente');
        return redirect()->route('admin.productos.reporte');
    }

    // 4. EDITAR (Antes edit)
    public function editar($id) {
        $producto = Productos::find($id);
        if (!$producto) {
            return redirect()->route('admin.productos.reporte');
        }
        return view('admin.productos.edit', compact('producto'));
    }

    // 5. ACTUALIZAR (Antes update)
    public function actualizar(Request $request) {
        // Buscamos por el ID del formulario oculto
        $prod = Productos::find($request->id);

        if (!$prod) {
            return redirect()->route('admin.productos.reporte');
        }

        $reglas = [
            'nombre'      => 'required|string|max:100|not_regex:/^[0-9]+$/',
            'descripcion' => 'nullable|string|max:500|not_regex:/^[0-9]+$/',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'nullable|integer|min:0',
            'activo'      => 'required|boolean', // Validamos el campo activo
            'imagen'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048' 
        ];

        $request->validate($reglas);

        if ($request->hasFile('imagen')) {
            if ($prod->imagen && File::exists(public_path($prod->imagen))) {
                File::delete(public_path($prod->imagen));
            }
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagen'), $filename);
            $prod->imagen = 'imagen/' . $filename;
        }
        
        $prod->nombre      = $request->nombre;
        $prod->descripcion = $request->descripcion;
        $prod->precio      = $request->precio;
        $prod->stock       = $request->stock;
        $prod->activo      = $request->activo; // Actualizamos el estado

        $prod->save();

        Session::flash('mensaje', 'Producto actualizado exitosamente');
        return redirect()->route('admin.productos.reporte');
    }

    // 6. ELIMINAR (Antes destroy)
    public function eliminar($id) {
        $prod = Productos::find($id);
        
        if ($prod) {
            if ($prod->imagen && File::exists(public_path($prod->imagen))) {
                File::delete(public_path($prod->imagen));
            }
            $prod->delete();
            Session::flash('mensaje', 'Producto eliminado');
        }
        
        return redirect()->route('admin.productos.reporte');
    }
}