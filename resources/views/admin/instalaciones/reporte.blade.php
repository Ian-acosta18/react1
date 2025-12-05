@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper">
    
    <div class="page-header fade-in">
        <div class="header-titles">
            <span class="muted-label">Infraestructura</span>
            <h2>Reporte de Instalaciones</h2>
        </div>
        <a href="{{ route('admin.instalaciones.alta') }}" class="btn-create-new">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nueva Instalación
        </a>
    </div>

    @if(Session::has('mensaje'))
        <div class="alert-premium success fade-in">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ Session::get('mensaje') }}
        </div>
    @endif

    <div class="table-card fade-in-up">
        <div class="table-responsive">
            <table class="table-premium">
                <thead>
                    <tr>
                        <th width="10%">Orden</th>
                        <th width="15%">Foto</th>
                        <th width="40%">Título</th>
                        <th width="15%">Estado</th>
                        <th width="20%" class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instalaciones as $inst)
                    <tr>
                        <td style="text-align: center; color: #999; font-weight: bold;">
                            #{{ $inst->orden }}
                        </td>
                        <td>
                            <div class="img-avatar-container" style="width: 80px; height: 60px;">
                                <img src="{{ asset($inst->imagen) }}" alt="foto">
                            </div>
                        </td>
                        <td class="fw-bold-title">{{ $inst->titulo }}</td>
                        <td>
                            @if($inst->activo)
                                <span class="badge-categoria" style="background-color: #ecfdf5; color: #065f46; border: 1px solid #d1fae5;">Activo</span>
                            @else
                                <span class="badge-categoria" style="background-color: #f3f4f6; color: #6b7280; border: 1px solid #e5e7eb;">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="action-buttons">
                                <a href="{{ route('admin.instalaciones.editar', ['id' => $inst->id]) }}" class="btn-icon edit" title="Editar">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <a href="{{ route('admin.instalaciones.eliminar', ['id' => $inst->id]) }}" class="btn-icon delete" onclick="return confirm('¿Borrar?')" title="Eliminar">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bottom-nav mt-4">
        <a href="{{ route('admin.dashboard') }}" class="link-back">&larr; Volver al Panel</a>
    </div>
</div>
@endsection