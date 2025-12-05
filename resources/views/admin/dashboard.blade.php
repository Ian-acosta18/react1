@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 50px; margin-bottom: 80px;">
    
    <div class="text-center mb-5">
        <h1 style="font-family: 'Playfair Display', serif; color: #B98D7B;">Panel de Administración</h1>
        <p class="lead">Bienvenido, <strong>{{ Session::get('admin_session') }}</strong>. ¿Qué deseas gestionar hoy?</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s;">
                <div class="card-body text-center p-5">
                    <h3 style="color: #5c4b45;">Servicios</h3>
                    <p class="text-muted">Corte, Tinte, Masajes...</p>
                    <hr>
                    <a href="{{ route('admin.servicios.reporte') }}" class="btn btn-block w-100" style="background-color: #B98D7B; color: white;">Entrar a Servicios</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s;">
                <div class="card-body text-center p-5">
                    <h3 style="color: #5c4b45;">Productos</h3>
                    <p class="text-muted">Bolsos, Cremas, Accesorios...</p>
                    <hr>
                    <a href="{{ route('admin.productos.reporte') }}" class="btn btn-primary">Entrar a Productos</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s;">
                <div class="card-body text-center p-5">
                    <h3 style="color: #5c4b45;">Instalaciones</h3>
                    <p class="text-muted">Áreas del Spa, Cabinas...</p>
                    <hr>
                    <a href="#" class="btn btn-secondary w-100 disabled">Próximamente</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('cerrarsesion') }}" class="text-danger" style="text-decoration: none; font-weight: bold;">
            &larr; Cerrar Sesión
        </a>
    </div>
</div>
@endsection