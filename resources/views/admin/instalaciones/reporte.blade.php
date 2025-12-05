@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="admin-header">
        <h2>Reporte de Instalaciones</h2>
        <a href="{{ route('admin.instalaciones.alta') }}" class="btn-nuevo">+ Nueva Instalación</a>
    </div>

    @if(Session::has('mensaje'))
        <div class="alert alert-success">{{ Session::get('mensaje') }}</div>
    @endif

    <table class="tabla-admin">
        <thead>
            <tr>
                <th>Orden</th>
                <th>Foto</th>
                <th>Título</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($instalaciones as $inst)
            <tr>
                <td style="text-align: center;">{{ $inst->orden }}</td>
                <td>
                    <img src="{{ asset($inst->imagen) }}" width="60" style="border-radius:5px;">
                </td>
                <td>{{ $inst->titulo }}</td>
                <td>
                    @if($inst->activo) <span class="badge bg-success" style="color:green;">Activo</span>
                    @else <span class="badge bg-secondary" style="color:gray;">Inactivo</span> @endif
                </td>
                <td>
                    <a href="{{ route('admin.instalaciones.editar', ['id' => $inst->id]) }}" class="btn-accion btn-editar">Editar</a>
                    <a href="{{ route('admin.instalaciones.eliminar', ['id' => $inst->id]) }}" class="btn-accion btn-borrar" onclick="return confirm('¿Borrar?')">Borrar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection