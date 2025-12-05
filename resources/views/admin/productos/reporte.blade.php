@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="admin-header">
        <h2>Reporte de Productos</h2>
        <a href="{{ route('admin.productos.alta') }}" class="btn-nuevo">+ Nuevo Producto</a>
    </div>

    @if(Session::has('mensaje'))
        <div class="alert alert-success">{{ Session::get('mensaje') }}</div>
    @endif

    <table class="tabla-admin">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $p)
            <tr>
                <td>
                    @if($p->imagen != "" && file_exists(public_path($p->imagen)))
                        <img src="{{ asset($p->imagen) }}" alt="foto" width="60" height="60" style="object-fit: cover; border-radius: 5px;">
                    @else
                        <img src="{{ asset('imagen/sinfoto.jpg') }}" alt="sin foto" width="60" height="60" style="object-fit: cover; border-radius: 5px; opacity: 0.5;">
                    @endif
                </td>
                <td>{{ $p->nombre }}</td>
                <td style="max-width: 200px; font-size: 0.9em; color: #666;">{{ Str::limit($p->descripcion, 50) }}</td>
                <td>{{ $p->stock }}</td>
                <td>${{ number_format($p->precio, 2) }}</td>
                <td>
                    <a href="{{ route('admin.productos.editar', ['id' => $p->id]) }}" class="btn-accion btn-editar">Modificar</a>
                    <a href="{{ route('admin.productos.eliminar', ['id' => $p->id]) }}" class="btn-accion btn-borrar" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <a href="{{ route('admin.dashboard') }}">Volver al Dashboard</a>
</div>
@endsection