@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; max-width: 700px;">
    <h2>Nueva Instalación</h2>

    <form action="{{ route('admin.instalaciones.guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label>Título:</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" rows="3" required></textarea>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Orden (Número):</label>
                <input type="number" name="orden" class="form-control" value="0">
            </div>
            <div class="col-md-6">
                <label>Estado:</label>
                <select name="activo" class="form-control">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Imagen:</label>
            <input type="file" name="foto" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.instalaciones.reporte') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection