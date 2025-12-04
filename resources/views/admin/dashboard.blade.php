@extends('layouts.app')

@section('content')
<div class="container" style="margin: 50px auto; text-align: center;">
    <h1>Bienvenido, {{ Session::get('admin_session') }}</h1>
    <p class="lead">Panel de Administración Aura Spa</p>
    <hr>
    
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4 shadow-sm">
                <h3>Servicios</h3>
                <p>Gestionar precios, categorías y fotos.</p>
                <a href="{{ route('admin.servicios.reporte') }}" class="btn btn-dark">Administrar</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 shadow-sm" style="opacity: 0.5;">
                <h3>Productos</h3>
                <p>Próximamente...</p>
                <button class="btn btn-secondary" disabled>En construcción</button>
            </div>
        </div>
    </div>
    
    <br><br>
    <a href="{{ route('cerrarsesion') }}" class="btn btn-danger">Cerrar Sesión</a>
</div>
@endsection