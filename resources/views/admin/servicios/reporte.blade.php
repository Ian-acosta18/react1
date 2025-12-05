@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper">
    
    <div class="page-header fade-in">
        <div class="header-titles">
            <span class="muted-label">Panel de Administración</span>
            <h2>Catálogo de Servicios</h2>
        </div>
        <a href="{{ route('admin.servicios.alta') }}" class="btn-create-new">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nuevo Servicio
        </a>
    </div>

    @if(Session::has('mensaje'))
        <div class="alert-premium success fade-in">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ Session::get('mensaje') }}
        </div>
    @endif

    <div class="table-card fade-in-up">
        <div class="table-responsive">
            <table class="table-premium">
                <thead>
                    <tr>
                        <th width="10%">Imagen</th>
                        <th width="30%">Nombre del Servicio</th>
                        <th width="25%">Categoría</th>
                        <th width="15%">Precio</th>
                        <th width="20%" class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios as $s)
                    <tr>
                        <td>
                            <div class="img-avatar-container">
                                @if($s->imagen != "" && file_exists(public_path($s->imagen)))
                                    <img src="{{ asset($s->imagen) }}" alt="{{ $s->nombre_servicio }}">
                                @else
                                    <img src="{{ asset('imagen/sinfoto.jpg') }}" alt="sin foto" class="img-placeholder">
                                @endif
                            </div>
                        </td>
                        <td class="fw-bold-title">{{ $s->nombre_servicio }}</td>
                        <td>
                            <span class="badge-categoria">{{ $s->nombre_categoria }}</span>
                        </td>
                        <td class="price-text">${{ number_format($s->precio, 2) }}</td>
                        <td class="text-right">
                            <div class="action-buttons">
                                <a href="{{ route('admin.servicios.editar', ['id' => $s->id]) }}" class="btn-icon edit" title="Editar">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <a href="{{ route('admin.servicios.eliminar', ['id' => $s->id]) }}" class="btn-icon delete" onclick="return confirm('¿Seguro que deseas eliminar este servicio?')" title="Eliminar">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(count($servicios) == 0)
            <div class="empty-state">
                <p>No hay servicios registrados en el sistema.</p>
            </div>
        @endif
    </div>

    <div class="bottom-nav mt-4">
        <a href="{{ route('admin.dashboard') }}" class="link-back">
            &larr; Volver al Panel
        </a>
    </div>
</div>
@endsection