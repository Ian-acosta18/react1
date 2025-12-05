<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use Session;
use File;

class AdminProductosController extends Controller
{
    // 1. REPORTE
    public function reporte()
    {
        $productos = Productos::orderBy('nombre', 'ASC')->get();
        return view('admin.productos.reporte')->with('productos', $productos);
    }

    // 2. ALTA (VISTA)
    public function alta()
    {
        return view('admin.productos.alta');
    }

    // 3. GUARDAR (ACCION)
    public function guardar(Request $request)
    {
        $this->validate($request, [
            'nombre'      => 'required',
            'descripcion' => 'required',
            'precio'      => 'required|numeric',
            'stock'       => 'required|numeric',
            'foto'        => 'image|mimes:jpg,jpeg,png'
        ]);

        $ruta_imagen = '';

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Nombre único: producto_timestamp.ext
            $img = 'producto_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('imagen'), $img);
            $ruta_imagen = 'imagen/' . $img;
        }

        $producto = new Productos;
        $producto->nombre      = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio      = $request->precio;
        $producto->stock       = $request->stock;
        $producto->imagen      = $ruta_imagen;
        $producto->activo      = 1; // Por defecto activo
        
        $producto->save();

        Session::flash('mensaje', "El producto $request->nombre ha sido creado.");
        return redirect()->route('admin.productos.reporte');
    }

    // 4. EDITAR (VISTA)
    public function editar($id)
    {
        $producto = Productos::find($id);

        if (!$producto) {
            Session::flash('mensaje', "El producto no existe.");
            return redirect()->route('admin.productos.reporte');
        }

        return view('admin.productos.edit')->with('producto', $producto);
    }

    // 5. ACTUALIZAR (ACCION)
    public function actualizar(Request $request)
    {
        $this->validate($request, [
            'id'          => 'required',
            'nombre'      => 'required',
            'descripcion' => 'required',
            'precio'      => 'required|numeric',
            'stock'       => 'required|numeric',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $producto = Productos::find($request->id);
        
        if (!$producto) {
            return redirect()->route('admin.productos.reporte');
        }

        if ($request->hasFile('foto')) {
            // Borrar foto anterior
            if ($producto->imagen && File::exists(public_path($producto->imagen))) {
                File::delete(public_path($producto->imagen));
            }
            // Subir nueva
            $file = $request->file('foto');
            $img = 'producto_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('imagen'), $img);
            $producto->imagen = 'imagen/' . $img; 
        }

        $producto->nombre      = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio      = $request->precio;
        $producto->stock       = $request->stock;
        
        $producto->save();

        Session::flash('mensaje', "El producto ha sido actualizado correctamente.");
        return redirect()->route('admin.productos.reporte');
    }

    // 6. ELIMINAR (ACCION)
    public function eliminar($id)
    {
        $producto = Productos::find($id);

        if ($producto) {
            if ($producto->imagen && File::exists(public_path($producto->imagen))) {
                File::delete(public_path($producto->imagen));
            }
            $producto->delete();
            Session::flash('mensaje', "Producto eliminado correctamente.");
        } else {
            Session::flash('mensaje', "No se pudo encontrar el producto.");
        }
        
        return redirect()->route('admin.productos.reporte');
    }
}