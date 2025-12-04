@extends('layouts.app')

@section('content')
<div style="padding: 2rem; max-width: 1200px; margin: 0 auto;">
    <div class="admin-header">
        <h2 style="font-family: var(--fuente-titulos); color: var(--color-principal);">Administrar Servicios</h2>
        <a href="{{ route('servicios.create') }}" class="btn-nuevo">Nuevo Servicio</a>
    </div>

    <table class="tabla-admin">
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Servicio</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servicios as $serv)
            <tr>
                {{-- Usamos optional() por si se borró la categoría --}}
                <td>{{ optional($serv->categoria)->nombre_categoria ?? 'Sin Categoría' }}</td>
                <td>{{ $serv->nombre_servicio }}</td>
                <td>${{ number_format($serv->precio, 2) }}</td>
                <td>
                    <a href="{{ route('servicios.edit', $serv->id) }}" class="btn-accion btn-editar">Editar</a>
                    <form action="{{ route('servicios.destroy', $serv->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn-accion btn-borrar" onclick="return confirm('¿Eliminar servicio?')">X</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection