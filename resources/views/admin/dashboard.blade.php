@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    
    <div class="dashboard-welcome">
        <h1>Bienvenido, {{ Session::get('admin_nombre') ?? 'Administrador' }}</h1>
        <p>Panel de Control AURA SPA</p>
    </div>
    
    <div class="admin-grid">
        
        <!-- Tarjeta 1: Servicios -->
        <div class="admin-card">
            <div>
                <span class="admin-card-icon">support_agent</span>
                <h3>Servicios</h3>
                <p>Gestiona el catálogo de tratamientos y precios.</p>
            </div>
            <a href="{{ route('servicios.index') }}" class="btn-admin">Administrar</a>
        </div>

        <!-- Tarjeta 2: Productos -->
        <div class="admin-card">
            <div>
                <span class="admin-card-icon">shopping_bag</span>
                <h3>Productos</h3>
                <p>Control de inventario y stock de productos.</p>
            </div>
            <a href="{{ route('productos.index') }}" class="btn-admin">Administrar</a>
        </div>

        <!-- Tarjeta 3: Instalaciones -->
        <div class="admin-card">
            <div>
                <span class="admin-card-icon">storefront</span>
                <h3>Instalaciones</h3>
                <p>Actualiza las fotos de las áreas del Spa.</p>
            </div>
            <a href="{{ route('instalaciones.index') }}" class="btn-admin">Administrar</a>
        </div>

         <!-- Tarjeta 4: Citas -->
         <div class="admin-card">
            <div>
                <span class="admin-card-icon">calendar_month</span>
                <h3>Citas</h3>
                <p>Ver solicitudes de reservación.</p>
            </div>
            <a href="{{ route('reportecitas') }}" class="btn-admin">Ver Citas</a>
        </div>

    </div>

    <div style="text-align: center; margin-top: 4rem;">
        <a href="{{ route('cerrarsesion') }}" class="btn-admin-danger">Cerrar Sesión</a>
    </div>
</div>

<!-- Iconos de Google -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 48; }
    .admin-card-icon { font-family: 'Material Symbols Outlined'; font-size: 3rem; display: block; margin-bottom: 10px; color: var(--color-principal); }
</style>
@endsection