@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 2rem auto;">
    <h2 class="seccion-titulo">Editar Servicio</h2>
    
    <form action="{{ route('servicios.update', $servicio->id) }}" method="POST" class="formulario" enctype="multipart/form-data"></form>
        @csrf
        @method('PUT')

        <div class="form-grupo">
            <label>Categoría:</label>
            <select name="categoria_id" required>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" {{ $servicio->categoria_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nombre_categoria }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-grupo">
            <label>Nombre del Servicio:</label>
            <input type="text" name="nombre_servicio" value="{{ $servicio->nombre_servicio }}" required>
        </div>

        <div class="form-grupo">
            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" value="{{ $servicio->precio }}" required>
        </div>

        <button type="submit" class="btn-submit">Actualizar Servicio</button>
        <a href="{{ route('servicios.index') }}" style="display:block; text-align:center; margin-top:1rem; color: #666;">Cancelar</a>
    </form>
</div>
@endsection