@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper">
    <div class="page-header fade-in">
        <h2>Catálogo de Servicios</h2>
        <a href="{{ route('admin.servicios.alta') }}" class="btn-create-new">+ Nuevo Servicio</a>
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
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Estado</th> {{-- NUEVA COLUMNA --}}
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios as $s)
                    <tr>
                        <td>
                            @if($s->imagen && file_exists(public_path($s->imagen)))
                                <img src="{{ asset($s->imagen) }}" width="50" style="border-radius:5px;">
                            @else
                                <img src="{{ asset('imagen/sinfoto.jpg') }}" width="50" style="opacity:0.5;">
                            @endif
                        </td>
                        <td>{{ $s->nombre_servicio }}</td>
                        <td>{{ $s->categoria ? $s->categoria->nombre_categoria : 'Sin Categoría' }}</td>
                        <td>${{ number_format($s->precio, 2) }}</td>
                        
                        {{-- ESTADO CON BADGE --}}
                        <td>
                            @if($s->activo)
                                <span class="badge bg-success" style="color: green; font-weight: bold;">Activo</span>
                            @else
                                <span class="badge bg-secondary" style="color: gray;">Inactivo</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.servicios.editar', $s->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <a href="{{ route('admin.servicios.eliminar', $s->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection