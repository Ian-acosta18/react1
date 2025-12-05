@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 2rem auto;">
    <h2 class="seccion-titulo">Editar Producto</h2>
    
    <form action="{{ route('admin.productos.actualizar') }}" method="POST" enctype="multipart/form-data" class="formulario">
        @csrf
        {{-- Campo oculto ID necesario para el controlador --}}
        <input type="hidden" name="id" value="{{ $producto->id }}">

        <div class="form-grupo">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
            @error('nombre') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        <div class="form-grupo">
            <label>Descripción:</label>
            <textarea name="descripcion" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="form-grupo" style="display: flex; gap: 1rem;">
            <div style="flex: 1;">
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" required>
            </div>
            <div style="flex: 1;">
                <label>Stock:</label>
                <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}">
            </div>
        </div>

        <div class="form-grupo">
            <label>Imagen Actual:</label>
            <div style="margin-bottom: 10px;">
                @if($producto->imagen && file_exists(public_path($producto->imagen)))
                    <img src="{{ asset($producto->imagen) }}" alt="Imagen actual" style="width: 100px; border-radius: 5px;">
                @else
                    <p style="color: #666;">Sin imagen actual</p>
                @endif
            </div>

            <label>Cambiar Imagen (Opcional):</label>
            <input type="file" name="imagen" accept="image/*" style="padding: 10px; background: white;">
            @error('imagen') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn-submit">Actualizar Producto</button>
        <a href="{{ route('admin.productos.reporte') }}" style="display:block; text-align:center; margin-top:1rem; color: #666;">Cancelar</a>
    </form>
</div>
@endsection