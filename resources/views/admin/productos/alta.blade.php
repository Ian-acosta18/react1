@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; max-width: 700px;">
    <h2>Alta de Producto</h2>
    
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.productos.guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
        </div>

        <div class="mb-3">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Stock (Cantidad):</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Imagen:</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Producto</button>
        <a href="{{ route('admin.productos.reporte') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection