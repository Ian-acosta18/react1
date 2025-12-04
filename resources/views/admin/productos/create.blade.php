@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 2rem auto;">
    <h2 class="seccion-titulo">Nuevo Producto</h2>
    
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="formulario">
        @csrf

        <div class="form-grupo">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" required>
        </div>

        <div class="form-grupo">
            <label>Descripción:</label>
            <textarea name="descripcion" rows="3"></textarea>
        </div>

        <div class="form-grupo" style="display: flex; gap: 1rem;">
            <div style="flex: 1;">
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" required>
            </div>
            <div style="flex: 1;">
                <label>Stock:</label>
                <input type="number" name="stock" value="1">
            </div>
        </div>

        <div class="form-grupo">
            <label>Imagen:</label>
            <input type="file" name="imagen" accept="image/*" required style="padding: 10px; background: white;">
        </div>

        <button type="submit" class="btn-submit">Guardar Producto</button>
        <a href="{{ route('productos.index') }}" style="display:block; text-align:center; margin-top:1rem; color: #666;">Cancelar</a>
    </form>
</div>
@endsection