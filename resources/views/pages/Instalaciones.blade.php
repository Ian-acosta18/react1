@extends('layouts.app')

@section('content')

{{-- HEADER: Diseño inmersivo coherente --}}
<div class="header-instalaciones">
    <div class="header-overlay">
        <h2 class="seccion-titulo">Santuario de Bienestar</h2>
        <p class="intro-texto">Descubre espacios donde el tiempo se detiene y tu tranquilidad es la única protagonista.</p>
    </div>
</div>

<div class="instalaciones-wrapper">

    {{-- SECCIÓN EQUIPO: Ahora con más autoridad y detalles --}}
    <div class="seccion-equipo">
        <div class="equipo-contenido">
            <span class="etiqueta-top">Nuestros Especialistas</span>
            <h3>Manos expertas, corazones dedicados</h3>
            <p>En AURA, nuestro capital más valioso es humano. Contamos con un equipo multidisciplinario de dermatólogos, esteticistas y terapeutas certificados, unidos por una pasión: la excelencia en el cuidado personal.</p>
            
            <div class="equipo-features">
                <div class="feature-item">
                    <span class="check">✓</span> Capacitación internacional continua
                </div>
                <div class="feature-item">
                    <span class="check">✓</span> Especialización en dermo-cosmética
                </div>
                <div class="feature-item">
                    <span class="check">✓</span> Protocolos de higiene hospitalaria
                </div>
            </div>

            <p class="texto-secundario">"No solo tratamos tu piel; creamos una experiencia holística que renueva tu energía vital."</p>
        </div>
    </div>

    {{-- GRID DE INSTALACIONES: Más rico en información --}}
    <h3 class="subtitulo-seccion">Recorre nuestras instalaciones</h3>
    
    <div class="instalaciones-grid">

        <div class="instalacion-card">
            <div class="imagen-container">
                <img src="{{ asset('imagen/spa_lacer_verde.jpg') }}" alt="Cabinas de Tratamiento">
                <div class="card-tag">Privacidad Total</div>
            </div>
            <div class="info">
                <h3>Cabinas Sensoriales</h3>
                <p>Espacios privados diseñados con aislamiento acústico y control de temperatura inteligente para garantizar tu desconexión absoluta del mundo exterior.</p>
                
                <ul class="lista-amenidades">
                    <li>✨ Aromaterapia ambiental</li>
                    <li>✨ Sonido envolvente suave</li>
                    <li>✨ Camillas térmicas ergonómicas</li>
                </ul>
            </div>
        </div>

        <div class="instalacion-card">
            <div class="imagen-container">
                <img src="{{ asset('imagen/spa2.jpg') }}" alt="Recepción y Lobby">
                <div class="card-tag">Atención Premium</div>
            </div>
            <div class="info">
                <h3>Lobby & Bienvenida</h3>
                <p>Tu experiencia comienza al cruzar la puerta. Un ambiente cálido donde serás recibido con nuestra bebida insignia y una toalla aromatizada.</p>
                
                <ul class="lista-amenidades">
                    <li>✨ Cortesias</li>
                    <li>✨ Trato personalizado </li>
                    <li>✨ Sala de espera confort</li>
                </ul>
            </div>
        </div>

        <div class="instalacion-card">
            <div class="imagen-container">
                <img src="{{ asset('imagen/spa1.jpg') }}" alt="Lounge de Relajación">
                <div class="card-tag">Relajación</div>
            </div>
            <div class="info">
                <h3>Camara de relajación</h3>
                <p>Antes y después de tu tratamiento, disfruta de nuestras áreas y equipo especializado equipado con todo lo necesario que ocupas.</p>
                
                <ul class="lista-amenidades">
                    <li>✨ Privacidad</li>
                    <li>✨ Seguridad</li>
                    <li>✨ Kit de amenidades premium</li>
                </ul>
            </div>
        </div>

    </div>
</div>

<style>
    /* --- ESTRUCTURA GENERAL --- */
    body {
        background-color: var(--color-fondo);
    }

    .instalaciones-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem 5rem 2rem;
    }

    /* --- HEADER MEJORADO --- */
    .header-instalaciones {
        text-align: center;
        padding: 5rem 1rem 4rem 1rem;
        background: linear-gradient(135deg, var(--color-tarjeta) 0%, var(--color-acento-claro) 100%);
        border-radius: 0 0 60% 60% / 30px; /* Curva más pronunciada y elegante */
        margin-bottom: 5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .seccion-titulo {
        font-family: var(--fuente-cursiva);
        font-size: 4rem;
        color: var(--color-principal);
        margin: 0;
        font-weight: 300;
        line-height: 1.2;
    }

    .intro-texto {
        font-size: 1.3rem;
        color: var(--color-texto);
        margin-top: 1.5rem;
        font-weight: 300;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .subtitulo-seccion {
        text-align: center;
        font-family: var(--fuente-titulos);
        color: var(--color-principal);
        font-size: 2.2rem;
        margin: 4rem 0 3rem 0;
        position: relative;
    }
    
    .subtitulo-seccion::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: var(--color-acento-claro);
        margin: 10px auto 0;
    }

    /* --- SECCIÓN EQUIPO (Diseño Tarjeta Horizontal) --- */
    .seccion-equipo {
        background: #fff;
        border-radius: 20px;
        padding: 3.5rem;
        box-shadow: 0 15px 50px rgba(92, 75, 69, 0.08);
        margin-bottom: 4rem;
        border-left: 6px solid var(--color-principal);
        position: relative;
    }

    .etiqueta-top {
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 2px;
        color: var(--color-acento-claro); /* O un color dorado si tienes */
        font-weight: bold;
        display: block;
        margin-bottom: 0.5rem;
    }

    .equipo-contenido h3 {
        color: var(--color-principal);
        font-family: var(--fuente-titulos);
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
    }

    .equipo-contenido p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--color-texto);
        margin-bottom: 1.5rem;
    }

    .equipo-features {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin: 2rem 0;
        padding: 1.5rem 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }

    .feature-item {
        font-size: 1rem;
        color: var(--color-principal);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .texto-secundario {
        font-style: italic;
        opacity: 0.8;
    }

    /* --- GRID DE INSTALACIONES --- */
    .instalaciones-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
    }

    .instalacion-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(0,0,0,0.03);
    }

    .instalacion-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(92, 75, 69, 0.15);
    }

    .imagen-container {
        width: 100%;
        height: 240px;
        position: relative;
        overflow: hidden;
    }

    .imagen-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .instalacion-card:hover .imagen-container img {
        transform: scale(1.08);
    }

    .card-tag {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255,255,255,0.9);
        color: var(--color-principal);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .info {
        padding: 2rem;
        flex-grow: 1; /* Asegura que todas las tarjetas se alineen igual */
        display: flex;
        flex-direction: column;
    }

    .info h3 {
        font-family: var(--fuente-titulos);
        font-size: 1.5rem;
        color: var(--color-principal);
        margin-bottom: 0.8rem;
    }

    .info p {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #666;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 1.5rem;
    }

    /* Lista de amenidades dentro de la tarjeta */
    .lista-amenidades {
        list-style: none;
        padding: 0;
        margin: 0;
        margin-top: auto; /* Empuja la lista hacia abajo */
    }

    .lista-amenidades li {
        font-size: 0.9rem;
        color: var(--color-texto);
        margin-bottom: 0.6rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .instalaciones-grid {
            grid-template-columns: 1fr;
        }

        .seccion-equipo {
            padding: 2rem;
        }
        
        .equipo-features {
            flex-direction: column;
            gap: 1rem;
        }

        .seccion-titulo {
            font-size: 3rem;
        }
    }
</style>

@endsection