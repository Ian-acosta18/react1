@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 50px;">
    <h2>Administración de Servicios</h2>
    
    @if(Session::has('mensaje'))
        <div class="alert alert-success">{{ Session::get('mensaje') }}</div>
    @endif

    <div class="text-end mb-3">
        <a href="{{ route('altaservicio') }}" class="btn btn-success">Agrear Nuevo Servicio</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Volver al Panel</a>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Servicio</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servicios as $ser)
            <tr>
                <td>{{ $ser->id }}</td> <td>{{ $ser->nombre_servicio }}</td>
                <td>{{ $ser->categoria->nombre_categoria }}</td>
                <td>${{ $ser->precio }}</td>
                <td>
                    <a href="{{ route('editaservicio', ['id_servicio' => $ser->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                    
                    <a href="{{ route('eliminaservicio', ['id_servicio' => $ser->id]) }}" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Seguro que deseas eliminar este servicio?')">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection