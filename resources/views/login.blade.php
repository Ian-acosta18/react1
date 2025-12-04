@extends('layouts.app')

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">
            <h2>Acceso Administrativo</h2>
            <p>Ingresa tus credenciales para gestionar AURA</p>
        </div>
        
        @if(Session::has('mensaje'))
            <div style="background-color: #ffe6e6; color: #d9534f; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #ffcccc;">
                {{ Session::get('mensaje') }}
            </div>
        @endif

        <form action="{{ route('validar') }}" method="POST">
            @csrf
            
            {{-- Usamos tus clases .form-grupo existentes para mantener el diseño --}}
            <div class="form-grupo" style="text-align: left;">
                <label>Correo Electrónico:</label>
                <input type="text" name="correo" placeholder="ejemplo@aura.com" value="{{ old('correo') }}">
                @if($errors->has('correo')) 
                    <small style="color: #d9534f;">{{ $errors->first('correo') }}</small> 
                @endif
            </div>

            <div class="form-grupo" style="text-align: left;">
                <label>Contraseña:</label>
                <input type="password" name="password" placeholder="••••••••">
                @if($errors->has('password')) 
                    <small style="color: #d9534f;">{{ $errors->first('password') }}</small> 
                @endif
            </div>

            <button type="submit" class="btn-shiner" style="width: 100%; margin-top: 1rem;">
                Iniciar Sesión
            </button>
        </form>
        
        <div style="margin-top: 2rem;">
            <a href="{{ route('inicio') }}" style="color: #888; text-decoration: none; font-size: 0.9rem;">← Volver al inicio</a>
        </div>
    </div>
</div>
@endsection