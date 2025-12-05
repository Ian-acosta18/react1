@extends('layouts.app')

@section('content')

{{-- 1. SECCIÓN HERO (MEJORADA) --}}
<section class="hero-inicio fade-in">
    <div class="hero-contenido-inicio">
        <span class="subtitulo-decorativo">Bienestar & Armonía</span>
        <h1>Tu Santuario de <br>Belleza y Calma</h1>
        <p>En AURA, cada tratamiento es un ritual personalizado. Redescubre tu brillo interior en un ambiente diseñado para tu total relajación.</p>
        <div class="botones-hero">
            <a href="{{ route('reservaciones') }}" class="btn-inicio-reserva">Agenda tu Cita</a>
            <a href="{{ route('servicios') }}" class="btn-secundario">Ver Servicios</a>
        </div>
    </div>
    <div class="hero-imagen-decorativa">
        {{-- Usamos un contenedor para efecto de marco --}}
        <div class="marco-imagen">
            <img src="{{ asset('imagen/spa_risos_corona.jpg') }}" alt="Experiencia Aura Spa">
        </div>
    </div>
</section>

{{-- 2. SECCIÓN DE VALORES (ICONOS) --}}
<section class="seccion-valores">
    <div class="valor-card">
        <div class="icono">🌿</div>
        <h3>Productos Orgánicos</h3>
        <p>Utilizamos solo ingredientes naturales y libres de crueldad animal.</p>
    </div>
    <div class="valor-card">
        <div class="icono">✨</div>
        <h3>Expertos Certificados</h3>
        <p>Tu belleza en manos de profesionales con años de experiencia.</p>
    </div>
    <div class="valor-card">
        <div class="icono">🕯️</div>
        <h3>Ambiente Zen</h3>
        <p>Un espacio diseñado para desconectar del estrés diario.</p>
    </div>
</section>

{{-- 3. SERVICIOS DESTACADOS (PREVISUALIZACIÓN) --}}
<section class="seccion-destacados">
    <h2 class="seccion-titulo">Nuestros Rituales Favoritos</h2>
    <p class="texto-centro">Descubre los tratamientos más solicitados por nuestros clientes</p>
    
    <div class="grid-destacados">
        {{-- Tarjeta 1 --}}
        <div class="card-destacado">
            <div class="img-container">
                <img src="{{ asset('imagen/spa_uñas_aura.jpg') }}" alt="Manicure Spa">
            </div>
            <div class="info-destacado">
                <h3>Manicure Spa</h3>
                <p>Renovación total para tus manos.</p>
                <a href="{{ route('servicios') }}" class="link-detalle">Saber más &rarr;</a>
            </div>
        </div>

        {{-- Tarjeta 2 --}}
        <div class="card-destacado">
            <div class="img-container">
                <img src="{{ asset('imagen/spa_risos.jpg') }}" alt="Tratamiento Capilar">
            </div>
            <div class="info-destacado">
                <h3>Tratamiento Capilar</h3>
                <p>Hidratación profunda y brillo.</p>
                <a href="{{ route('servicios') }}" class="link-detalle">Saber más &rarr;</a>
            </div>
        </div>

        {{-- Tarjeta 3 --}}
        <div class="card-destacado">
            <div class="img-container">
                <img src="{{ asset('imagen/spa_cama_lacer.jpg') }}" alt="Masajes Relajantes">
            </div>
            <div class="info-destacado">
                <h3>Masajes Relajantes</h3>
                <p>Libera la tensión acumulada.</p>
                <a href="{{ route('servicios') }}" class="link-detalle">Saber más &rarr;</a>
            </div>
        </div>
    </div>
</section>

{{-- 4. SECCIÓN DE TESTIMONIOS (PRUEBA SOCIAL) --}}
<section class="seccion-testimonios">
    <div class="contenido-testimonio">
        <h2 class="seccion-titulo">Lo que dicen de Aura</h2>
        <blockquote class="cita-destacada">
            "Es el mejor lugar para desconectarse. El tratamiento facial me dejó la piel increíble y la atención es de primer nivel. ¡Volveré seguro!"
        </blockquote>
        <cite>- Mariana G., Cliente Frecuente</cite>
    </div>
</section>

{{-- 5. CALL TO ACTION FINAL --}}
<section class="cta-final">
    <h2>¿Lista para consentirte?</h2>
    <p>Reserva hoy y obtén un diagnóstico de piel gratuito.</p>
    <a href="{{ route('reservaciones') }}" class="btn-inicio-reserva btn-blanco">Reservar Ahora</a>
</section>

@endsection