@extends('layouts.app')

@section('content')
<div class="admin-content-wrapper">
    
    <div class="page-header fade-in">
        <div class="header-titles">
            <span class="muted-label">Inventario</span>
            <h2>Reporte de Productos</h2>
        </div>
        <a href="{{ route('admin.productos.alta') }}" class="btn-create-new">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nuevo Producto
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
                        <th width="10%">Foto</th>
                        <th width="25%">Nombre</th>
                        <th width="30%">Descripción</th>
                        <th width="10%">Stock</th>
                        <th width="10%">Precio</th>
                        <th width="15%" class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $p)
                    <tr>
                        <td>
                            <div class="img-avatar-container">
                                @if($p->imagen != "" && file_exists(public_path($p->imagen)))
                                    <img src="{{ asset($p->imagen) }}" alt="foto">
                                @else
                                    <img src="{{ asset('imagen/sinfoto.jpg') }}" alt="sin foto" class="img-placeholder">
                                @endif
                            </div>
                        </td>
                        <td class="fw-bold-title">{{ $p->nombre }}</td>
                        <td>
                            <span style="font-size: 0.9em; color: #888;">
                                {{ Str::limit($p->descripcion, 50) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-categoria" style="background: {{ $p->stock < 5 ? '#fee2e2' : '#f4f4f4' }}; color: {{ $p->stock < 5 ? '#ef4444' : '#666' }};">
                                {{ $p->stock }} u.
                            </span>
                        </td>
                        <td class="price-text">${{ number_format($p->precio, 2) }}</td>
                        <td class="text-right">
                            <div class="action-buttons">
                                <a href="{{ route('admin.productos.editar', ['id' => $p->id]) }}" class="btn-icon edit" title="Modificar">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <a href="{{ route('admin.productos.eliminar', ['id' => $p->id]) }}" class="btn-icon delete" onclick="return confirm('¿Seguro que deseas eliminar este producto?')" title="Eliminar">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if(count($productos) == 0)
            <div class="empty-state">
                <p>No hay productos registrados.</p>
            </div>
        @endif
    </div>

    <div class="bottom-nav mt-4">
        <a href="{{ route('admin.dashboard') }}" class="link-back">&larr; Volver al Panel</a>
    </div>
</div>
@endsection