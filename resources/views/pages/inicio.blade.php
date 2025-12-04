@extends('layouts.app')

@section('content')

<section class="hero-inicio">
    <div class="hero-imagen-decorativa">
        <img src="{{ asset('imagen/spa_risos_corona.jpg') }}" alt="Niña con corona de flores, peinado de Aura Beauty & Spa">
    </div>
    <div class="hero-contenido-inicio">
        <h1>Tu Santuario de Belleza y Calma</h1>
        <p>En AURA, cada tratamiento es un ritual personalizado. Redescubre tu brillo interior en un ambiente diseñado para tu total relajación.</p>
        <a href="{{ route('reservaciones') }}" class="btn-inicio-reserva">Agenda tu Experiencia</a>
    </div>
</section>

@endsection