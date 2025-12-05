@extends('layouts.app')

@section('content')

{{-- Estilos específicos integrados con el diseño de AURA --}}
<style>
    .intro-texto {
        text-align: center;
        max-width: 800px;
        margin: -1.5rem auto 3rem auto;
        color: var(--color-texto);
        font-size: 1.1rem;
    }

    .instalaciones-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        padding: 0 1rem;
    }

    .instalacion-card {
        background: var(--color-tarjeta);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(92, 75, 69, 0.1); 
        border: 1px solid var(--color-acento-claro);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .instalacion-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(92, 75, 69, 0.2);
    }

    .imagen-container {
        width: 100%;
        height: 250px;
        overflow: hidden;
        position: relative;
    }

    .imagen-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .instalacion-card:hover .imagen-container img {
        transform: scale(1.05);
    }

    .info {
        padding: 1.5rem;
        text-align: center;
    }

    .info h3 {
        font-family: var(--fuente-titulos);
        font-size: 1.5rem;
        color: var(--color-principal);
        margin-bottom: 0.5rem;
    }

    .info p {
        font-family: var(--fuente-cuerpo);
        font-size: 0.95rem;
        color: #6a5c57;
    }

    /* Estilos para la sección de Nuestro Equipo */
    .seccion-equipo {
        margin: 4rem auto 3rem auto;
        padding: 2rem;
        background: var(--color-tarjeta);
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(92, 75, 69, 0.05);
        max-width: 900px;
    }

    .seccion-equipo h3 {
        color: var(--color-principal);
        font-family: var(--fuente-titulos);
        font-size: 1.8rem;
        margin-bottom: 1rem;
        text-align: center;
    }

    .seccion-equipo p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--color-texto);
        text-align: justify;
        margin-bottom: 1rem;
    }

    .seccion-equipo p:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .instalaciones-grid {
            grid-template-columns: 1fr;
        }

        .seccion-equipo {
            padding: 1.5rem;
            margin: 3rem 1rem 2rem 1rem;
        }

        .seccion-equipo h3 {
            font-size: 1.5rem;
        }

        .seccion-equipo p {
            font-size: 1rem;
        }
    }
</style>

<h2 class="seccion-titulo">Nuestras Instalaciones</h2>
<p class="intro-texto">Conoce nuestros espacios diseñados para tu comodidad y relajación total.</p>

{{-- Sección de Nuestro Equipo --}}
<div class="seccion-equipo">
    <h3>Nuestro Equipo</h3>
    <p>Contamos con un equipo de especialistas apasionados por su trabajo, constantemente actualizados en las últimas técnicas y tendencias del sector. Cada miembro de AURA está comprometido con brindarte una experiencia única y personalizada.</p>
    <p>Nuestros profesionales no solo cuentan con certificaciones internacionales, sino que además comparten nuestra filosofía de cuidado integral, donde la belleza exterior es el reflejo del bienestar interior.</p>
</div>

<div class="instalaciones-grid">

    <div class="instalacion-card">
        <div class="imagen-container">
            <img src="{{ asset('imagen/spa_fondo_trabajo.jpg') }}" alt="Area de Trabajo">
        </div>
        <div class="info">
            <h3>Área de Trabajo</h3>
            <p>Equipamiento moderno y espacios perfectamente iluminados.</p>
        </div>
    </div>

    <div class="instalacion-card">
        <div class="imagen-container">
            <img src="{{ asset('imagen/spa2.jpg') }}" alt="Estacionamiento">
        </div>
        <div class="info">
            <h3>Recepción</h3>
            <p>Espacio amplio y acogedor para recibirte como mereces.</p>
        </div>
    </div>

    <div class="instalacion-card">
        <div class="imagen-container">
            <img src="{{ asset('imagen/spa1.jpg') }}" alt="Baños">
        </div>
        <div class="info">
            <h3>Area de tratamiento</h3>
            <p>Cómoda área diseñada para tu relajación previa al servicio.</p>
        </div>
    </div>

</div>

@endsection