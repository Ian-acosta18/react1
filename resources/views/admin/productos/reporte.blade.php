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
                <th>Estado</th> {{-- <--- COLUMNA AGREGADA --}}
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
                
                {{-- CELDA DE ESTADO (AGREGADA) --}}
                <td>
                    @if($p->activo)
                        <span class="badge bg-success" style="color: green; font-weight: bold; padding: 5px 10px; border-radius: 10px; background-color: #d1fae5;">Activo</span>
                    @else
                        <span class="badge bg-secondary" style="color: gray; font-weight: bold; padding: 5px 10px; border-radius: 10px; background-color: #f3f4f6;">Inactivo</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('admin.productos.editar', ['id' => $p->id]) }}" class="btn-accion btn-editar">Modificar</a>
                    <a href="{{ route('admin.productos.eliminar', ['id' => $p->id]) }}" class="btn-accion btn-borrar" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #666;">&larr; Volver al Dashboard</a>
    </div>
</div>

<style>
    /* Estilos para los badges de estado por si no los tienes globales */
    .badge-status {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .badge-status.success {
        background-color: #d1fae5;
        color: #065f46;
    }
    .badge-status.inactive {
        background-color: #f3f4f6;
        color: #6b7280;
    }
    .badge-stock {
        background-color: #e0e7ff;
        color: #3730a3;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 0.85rem;
    }
</style>
@endsection