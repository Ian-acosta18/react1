@extends('layouts.app')

@section('content')
<div style="padding: 2rem; max-width: 1200px; margin: 0 auto;">
    <div class="admin-header">
        <h2 style="font-family: var(--fuente-titulos); color: var(--color-principal);">Administrar Productos</h2>
        <a href="{{ route('productos.create') }}" class="btn-nuevo">Nuevo Producto</a>
    </div>

    <table class="tabla-admin">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $prod)
            <tr>
                <td><img src="{{ asset($prod->imagen) }}" width="60" style="border-radius: 5px;"></td>
                <td>{{ $prod->nombre }}</td>
                <td>${{ $prod->precio }}</td>
                <td>{{ $prod->stock }}</td>
                <td>
                    <a href="{{ route('productos.edit', $prod->id) }}" class="btn-accion btn-editar">Editar</a>
                    <form action="{{ route('productos.destroy', $prod->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion btn-borrar" onclick="return confirm('¿Borrar?')">X</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection