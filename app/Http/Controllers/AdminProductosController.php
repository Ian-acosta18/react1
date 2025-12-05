<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\StockOpcion; // Si usas el selector de stock predefinido (opcional)
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AdminProductosController extends Controller
{
    // 1. REPORTE
    public function reporte() {
        $productos = Productos::all();
        return view('admin.productos.reporte', compact('productos'));
    }

    // 2. ALTA
    public function alta() {
        // Si usas opciones de stock, las cargamos. Si no, puedes quitar esta línea o dejarla si tienes el modelo.
        // $stock_opciones = StockOpcion::orderBy('cantidad', 'asc')->get(); 
        // Si no tienes el modelo StockOpcion, usa:
        $stock_opciones = collect([]); 
        
        return view('admin.productos.alta', compact('stock_opciones'));
    }

    // 3. GUARDAR
    public function guardar(Request $request) {
        $reglas = [
            'nombre'      => 'required|string|max:100|unique:productos,nombre|not_regex:/^[0-9]+$/', 
            'descripcion' => 'nullable|string|max:500|not_regex:/^[0-9]+$/',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'nullable|integer|min:0',
            'activo'      => 'required|boolean', // <--- VALIDACIÓN NUEVA
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
        $prod->activo      = $request->activo; // <--- GUARDAR ESTADO

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
        $prod = Productos::find($request->id);

        if (!$prod) {
            return redirect()->route('admin.productos.reporte');
        }

        $reglas = [
            'nombre'      => 'required|string|max:100|not_regex:/^[0-9]+$/',
            'descripcion' => 'nullable|string|max:500|not_regex:/^[0-9]+$/',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'nullable|integer|min:0',
            'activo'      => 'required|boolean', // <--- VALIDACIÓN NUEVA
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
        $prod->activo      = $request->activo; // <--- ACTUALIZAR ESTADO

        $prod->save();

        Session::flash('mensaje', 'Producto actualizado exitosamente');
        return redirect()->route('admin.productos.reporte');
    }

    // 6. ELIMINAR
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