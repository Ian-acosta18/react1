@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper">
    <div class="page-header fade-in">
        <h2>Catálogo de Productos</h2>
        <a href="{{ route('admin.productos.alta') }}" class="btn-create-new">+ Nuevo Producto</a>
    </div>

    @if(Session::has('mensaje'))
        <div class="alert-premium success fade-in">{{ Session::get('mensaje') }}</div>
    @endif

    <div class="table-card fade-in-up">
        <div class="table-responsive">
            <table class="table-premium">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th> {{-- NUEVA COLUMNA --}}
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $prod)
                    <tr>
                        <td style="width: 100px;">
                            @if($prod->imagen && file_exists(public_path($prod->imagen)))
                                <img src="{{ asset($prod->imagen) }}" width="50" style="border-radius:5px;">
                            @else
                                <img src="{{ asset('imagen/sinfoto.jpg') }}" width="50" style="opacity:0.5;">
                            @endif
                        </td>
                        <td>{{ $prod->nombre }}</td>
                        <td>${{ number_format($prod->precio, 2) }}</td>
                        <td>{{ $prod->stock }}</td>
                        
                        {{-- COLUMNA ESTADO --}}
                        <td>
                            @if($prod->activo)
                                <span class="badge bg-success" style="color: green; font-weight: bold;">Activo</span>
                            @else
                                <span class="badge bg-secondary" style="color: gray;">Inactivo</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.productos.editar', $prod->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <a href="{{ route('admin.productos.eliminar', $prod->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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