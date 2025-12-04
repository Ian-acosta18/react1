@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="admin-header">
        <h2>Reporte de Servicios</h2>
        <a href="{{ route('admin.servicios.alta') }}" class="btn-nuevo">+ Nuevo Servicio</a>
    </div>

    @if(Session::has('mensaje'))
        <div class="alert alert-success">{{ Session::get('mensaje') }}</div>
    @endif

    <table class="tabla-admin">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servicios as $s)
            <tr>
                <td>
                    {{-- CORREGIDO: Lógica para mostrar imagen o sinfoto.jpg --}}
                    @if($s->imagen != "" && file_exists(public_path($s->imagen)))
                        <img src="{{ asset($s->imagen) }}" alt="foto" width="60" height="60" style="object-fit: cover; border-radius: 5px;">
                    @else
                        {{-- Asegúrate de tener esta imagen en public/imagen/sinfoto.jpg --}}
                        <img src="{{ asset('imagen/sinfoto.jpg') }}" alt="sin foto" width="60" height="60" style="object-fit: cover; border-radius: 5px; opacity: 0.5;">
                    @endif
                </td>
                <td>{{ $s->nombre_servicio }}</td>
                <td>{{ $s->nombre_categoria }}</td>
                <td>${{ number_format($s->precio, 2) }}</td>
                <td>
                    {{-- Verifica que tus rutas coincidan con las de web.php --}}
                    <a href="{{ route('admin.servicios.editar', ['id' => $s->id]) }}" class="btn-accion btn-editar">Modificar</a>
                    <a href="{{ route('admin.servicios.eliminar', ['id' => $s->id]) }}" class="btn-accion btn-borrar" onclick="return confirm('¿Seguro que deseas eliminar este servicio?')">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <a href="{{ route('admin.dashboard') }}">Volver al Dashboard</a>
</div>
@endsection