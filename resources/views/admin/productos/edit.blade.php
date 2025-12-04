@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 2rem auto;">
    <h2 class="seccion-titulo">Editar Producto</h2>
    
    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="formulario">
        @csrf
        @method('PUT')

        <div class="form-grupo">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" value="{{ $producto->nombre }}" required>
        </div>

        <div class="form-grupo">
            <label>Descripción:</label>
            <textarea name="descripcion" rows="3">{{ $producto->descripcion }}</textarea>
        </div>

        <div class="form-grupo" style="display: flex; gap: 1rem;">
            <div style="flex: 1;">
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" required>
            </div>
            <div style="flex: 1;">
                <label>Stock:</label>
                <input type="number" name="stock" value="{{ $producto->stock }}">
            </div>
        </div>

        <div class="form-grupo">
            <label>Imagen Actual:</label>
            <br>
            <img src="{{ asset($producto->imagen) }}" width="100" style="margin-bottom: 10px; border-radius: 5px;">
            <br>
            <label>Cambiar Imagen (Opcional):</label>
            <input type="file" name="imagen" accept="image/*" style="padding: 10px; background: white;">
        </div>

        <button type="submit" class="btn-submit">Actualizar Producto</button>
        <a href="{{ route('productos.index') }}" style="display:block; text-align:center; margin-top:1rem; color: #666;">Cancelar</a>
    </form>
</div>
@endsection