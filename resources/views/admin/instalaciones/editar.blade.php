@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; max-width: 700px;">
    <h2>Editar Instalación</h2>

    <form action="{{ route('admin.instalaciones.actualizar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $instalacion->id }}">

        <div class="mb-3">
            <label>Título:</label>
            <input type="text" name="titulo" class="form-control" value="{{ $instalacion->titulo }}" required>
        </div>

        <div class="mb-3">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" rows="3" required>{{ $instalacion->descripcion }}</textarea>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Orden:</label>
                <input type="number" name="orden" class="form-control" value="{{ $instalacion->orden }}">
            </div>
            <div class="col-md-6">
                <label>Estado:</label>
                <select name="activo" class="form-control">
                    <option value="1" {{ $instalacion->activo ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ !$instalacion->activo ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Imagen Actual:</label><br>
            <img src="{{ asset($instalacion->imagen) }}" width="150" style="margin-bottom: 10px; border-radius:5px;">
            <input type="file" name="foto" class="form-control">
            <small class="text-muted">Deja este campo vacío si no quieres cambiar la imagen.</small>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.instalaciones.reporte') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection