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
                            <a href="{{ route('admin.servicios.editar', $s->id) }}" class="btn-icon edit" title="Modificar">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>


                            <a href="{{ route('admin.servicios.eliminar', $s->id) }}" class="btn-icon delete" onclick="return confirm('¿Seguro que deseas eliminar este servicio?')" title="Eliminar">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>

                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection