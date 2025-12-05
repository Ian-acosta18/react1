@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; max-width: 700px;">
    <h2>Alta de Servicio</h2>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.servicios.guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label>Nombre del Servicio:</label>
            <input type="text" name="nombre_servicio" class="form-control" value="{{ old('nombre_servicio') }}" required>
        </div>

        <div class="mb-3">
            <label>Categoría:</label>
            <select name="categoria_id" class="form-control" required>
                <option value="">Seleccione una opción...</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nombre_categoria }}</option>
                @endforeach
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio') }}" required>
            </div>
            
            {{-- NUEVO CAMPO: ESTADO --}}
            <div class="col-md-6">
                <label>Estado:</label>
                <select name="activo" class="form-control">
                    <option value="1" selected>Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Foto:</label>
            <input type="file" name="foto" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.servicios.reporte') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection