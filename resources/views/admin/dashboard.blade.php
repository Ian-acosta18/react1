@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    
    <div class="dashboard-header fade-in">
        <span class="subtitulo-admin">Panel de Control</span>
        <h1>Bienvenido, {{ Session::get('admin_session') }}</h1>
        <p>Selecciona el módulo que deseas gestionar hoy</p>
    </div>

    <div class="admin-grid fade-in-up">
        
        <div class="admin-card">
            <div class="card-icon-bg">
                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 22c4.97 0 9-4.03 9-9 0-4.97-9-13-9-13S3 8.03 3 13c0 4.97 4.03 9 9 9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 13a3 3 0 100-6 3 3 0 000 6z"></path></svg>
            </div>
            <h3>Servicios</h3>
            <p>Gestión de cortes, masajes y tratamientos.</p>
            <a href="{{ route('admin.servicios.reporte') }}" class="btn-admin-card">
                Administrar Servicios →
            </a>
        </div>

        <div class="admin-card">
            <div class="card-icon-bg">
                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <h3>Productos</h3>
            <p>Inventario de cremas, aceites y accesorios.</p>
            <a href="{{ route('admin.productos.reporte') }}" class="btn-admin-card">
                Administrar Productos →
            </a>
        </div>

        <div class="admin-card">
            <div class="card-icon-bg">
                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </div>
            <h3>Instalaciones</h3>
            <p>Mantenimiento de cabinas y áreas comunes.</p>
            <a href="{{ route('admin.instalaciones.reporte') }}" class="btn-admin-card">
                Administrar Instalaciones →
            </a>
        </div>

    </div>

    <div class="dashboard-footer mt-5 fade-in">
        <a href="{{ route('cerrarsesion') }}" class="btn-logout">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right: 5px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Cerrar Sesión
        </a>
    </div>

</div>
@endsection