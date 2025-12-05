<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos; // Asegúrate de que tu modelo se llame "Productos.php"
use Session;
use File;

class AdminProductosController extends Controller
{
    public function reporte()
    {
        $productos = Productos::orderBy('nombre', 'ASC')->get();
        return view('admin.productos.reporte')->with('productos', $productos);
    }

    public function alta()
    {
        return view('admin.productos.alta');
    }

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
        $producto->activo      = 1;
        
        $producto->save();

        Session::flash('mensaje', "El producto $request->nombre ha sido creado.");
        return redirect()->route('admin.productos.reporte');
    }

    public function editar($id)
    {
        $producto = Productos::find($id);

        if (!$producto) {
            Session::flash('mensaje', "El producto no existe.");
            return redirect()->route('admin.productos.reporte');
        }

        return view('admin.productos.edit')->with('producto', $producto);
    }

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
            if ($producto->imagen && File::exists(public_path($producto->imagen))) {
                File::delete(public_path($producto->imagen));
            }
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