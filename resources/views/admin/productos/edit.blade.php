@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 2rem auto;">
    <h2 class="seccion-titulo">Editar Producto</h2>
    
    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="formulario">
        @csrf
        @method('PUT') <div class="form-grupo">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
            @error('nombre')
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grupo">
            <label>Descripción:</label>
            <textarea name="descripcion" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
            @error('descripcion')
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grupo" style="display: flex; gap: 1rem;">
            <div style="flex: 1;">
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" required>
                @error('precio')
                    <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </div>
            <div style="flex: 1;">
                <label>Stock:</label>
                <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}">
                @error('stock')
                    <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-grupo">
            <label>Imagen Actual:</label>
            <div style="margin-bottom: 10px;">
                @if($producto->imagen)
                    <img src="{{ asset($producto->imagen) }}" alt="Imagen actual" style="width: 100px; height: auto; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                @else
                    <p style="color: #666; font-style: italic;">Sin imagen actual</p>
                @endif
            </div>

            <label>Cambiar Imagen (Opcional):</label>
            <input type="file" name="imagen" accept="image/*" style="padding: 10px; background: white;">
            <small style="display:block; color: #666; margin-top: 5px;">Deja este campo vacío si deseas conservar la imagen actual.</small>
            @error('imagen')
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Actualizar Producto</button>
        <a href="{{ route('admin.productos.reporte') }}" style="display:block; text-align:center; margin-top:1rem; color: #666;">Cancelar</a>
    </form>
</div>
@endsection