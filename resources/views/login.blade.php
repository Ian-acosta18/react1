@extends('layouts.app')

@section('content')
<div class="login-wrapper">
    <div class="login-card fade-in">
        <div class="login-header">
            <div class="icon-brand">
                <span>✿</span>
            </div>
            <h2>Acceso Administrativo</h2>
            <p>Ingresa tus credenciales para gestionar el Spa</p>
        </div>
    
        @if(Session::has('error'))
            <div class="alert alert-danger custom-alert">
                {{ Session::get('error') }}
            </div>
        @endif

        <form action="{{ route('validar') }}" method="POST" class="login-form">
            @csrf
            
            <div class="input-group-custom">
                <label for="correo">Correo Electrónico</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </span>
                    <input type="email" id="correo" name="correo" required placeholder="nombre@ejemplo.com">
                </div>
            </div>

            <div class="input-group-custom">
                <label for="password">Contraseña</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </span>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="btn-login">
                Ingresar al Panel
            </button>
            
            <div class="login-footer">
                <a href="{{ url('/') }}">← Volver al sitio web</a>
            </div>
        </form>
    </div>
</div>
@endsection