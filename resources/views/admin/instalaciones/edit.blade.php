@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 2rem auto;">
    <h2 class="seccion-titulo">Editar Instalación</h2>
    
    <form action="{{ route('instalaciones.update', $instalacion->id) }}" method="POST" enctype="multipart/form-data" class="formulario">
        @csrf
        @method('PUT')

        <div class="form-grupo">
            <label>Título:</label>
            <input type="text" name="titulo" value="{{ $instalacion->titulo }}" required>
        </div>

        <div class="form-grupo">
            <label>Descripción:</label>
            <textarea name="descripcion" rows="3" required>{{ $instalacion->descripcion }}</textarea>
        </div>

        <div class="form-grupo">
            <label>Imagen Actual:</label><br>
            <img src="{{ asset($instalacion->imagen) }}" width="150" style="margin-bottom:10px; border-radius:5px;"><br>
            
            <label>Cambiar Imagen (Opcional):</label>
            <input type="file" name="imagen" accept="image/*" style="padding: 10px; background: white;">
        </div>

        <button type="submit" class="btn-submit">Actualizar Instalación</button>
        <a href="{{ route('instalaciones.index') }}" style="display:block; text-align:center; margin-top:1rem; color: #666;">Cancelar</a>
    </form>
</div>
@endsection