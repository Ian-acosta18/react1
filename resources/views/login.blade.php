@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 50px; margin-bottom: 50px; max-width: 500px;">
    <h2 class="text-center">Acceso Administrativo</h2>
    
    @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <form action="{{ route('validar') }}" method="POST" style="background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        @csrf
        <div class="mb-3">
            <label>Correo Electrónico:</label>
            <input type="email" name="correo" class="form-control" required placeholder="ej. administrador01@gmail.com">
        </div>
        <div class="mb-3">
            <label>Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100" style="background-color: #B98D7B; border:none;">Ingresar</button>
    </form>
</div>
@endsection