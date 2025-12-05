@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; max-width: 700px;">
    <h2>Editar Producto</h2>
    
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.productos.actualizar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $producto->id }}">

        <div class="mb-3">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio', $producto->precio) }}" required>
            </div>
            <div class="col-md-6">
                <label>Stock:</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $producto->stock) }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Imagen Actual:</label><br>
            @if($producto->imagen && file_exists(public_path($producto->imagen)))
                <img src="{{ asset($producto->imagen) }}" width="150" class="mb-2 rounded">
            @else
                <p class="text-muted">Sin imagen</p>
            @endif
            
            <label>Cambiar Imagen (Opcional):</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        <a href="{{ route('admin.productos.reporte') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection