@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 2rem auto;">
    <h2 class="seccion-titulo">Nuevo Servicio</h2>
    
    <form action="{{ route('servicios.store') }}" method="POST" class="formulario" enctype="multipart/form-data">
        @csrf

        <div class="form-grupo">
            <label>Categoría:</label>
            <select name="categoria_id" required>
                <option value="">-- Selecciona una categoría --</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nombre_categoria }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-grupo">
            <label>Nombre del Servicio:</label>
            <input type="text" name="nombre_servicio" placeholder="Ej: Corte de Caballero" required>
        </div>

        <div class="form-grupo">
        <label>Imagen del Servicio (Opcional):</label>
        <input type="file" name="imagen" accept="image/*">
        </div>

        <div class="form-grupo">
            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" placeholder="0.00" required>
        </div>

        <button type="submit" class="btn-submit">Guardar Servicio</button>
        <a href="{{ route('servicios.index') }}" style="display:block; text-align:center; margin-top:1rem; color: #666;">Cancelar</a>
    </form>
</div>
@endsection