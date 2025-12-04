@extends('layouts.app')

@section('content')
<div style="padding: 2rem; text-align: center;">
    <h1 style="font-family: var(--fuente-titulos); color: var(--color-principal);">¡Gracias, {{ $datos['nombre'] }}!</h1>
    
    {{-- CORRECCIÓN: Usamos 'servicios' (plural) y 'fechadeseada' para coincidir con el controlador --}}
    <p>Hemos recibido tu solicitud de reserva para: <strong>{{ $datos['servicios'] }}</strong></p>
    
    <p>Agendado para el día <strong>{{ $datos['fechadeseada'] }}</strong> a las <strong>{{ $datos['horadeseada'] }}</strong>.</p>
    
    <p>Te contactaremos a tu correo (<strong>{{ $datos['correo'] }}</strong>) o teléfono (<strong>{{ $datos['telefono'] }}</strong>) muy pronto para confirmar la disponibilidad.</p>
    
    <br>
    <a href="{{ route('inicio') }}" style="text-decoration: none; background: var(--color-principal); color: #fff; padding: 0.5rem 1rem; border-radius: 5px;">Volver al Inicio</a>
</div>
@endsection