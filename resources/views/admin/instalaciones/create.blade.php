@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 2rem auto;">
    <h2 class="seccion-titulo">Nueva Instalación</h2>
    
    <form action="{{ route('instalaciones.store') }}" method="POST" enctype="multipart/form-data" class="formulario">
        @csrf

        <div class="form-grupo">
            <label>Título (Ej: Sala de Masajes):</label>
            <input type="text" name="titulo" required>
        </div>

        <div class="form-grupo">
            <label>Descripción Corta:</label>
            <textarea name="descripcion" rows="3" required></textarea>
        </div>

        <div class="form-grupo">
            <label>Foto de la Instalación:</label>
            <input type="file" name="imagen" accept="image/*" required style="padding: 10px; background: white;">
        </div>

        <button type="submit" class="btn-submit">Guardar Instalación</button>
        <a href="{{ route('instalaciones.index') }}" style="display:block; text-align:center; margin-top:1rem; color: #666;">Cancelar</a>
    </form>
</div>
@endsection