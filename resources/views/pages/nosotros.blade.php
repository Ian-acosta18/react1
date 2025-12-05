@extends('layouts.app')

@section('content')

<div class="header-nosotros">
    <div class="header-overlay">
        <h2 class="seccion-titulo">Nuestra Esencia</h2>
        <p class="subtitulo-header">Un viaje hacia tu mejor versión</p>
    </div>
</div>

<div class="nosotros-wrapper">

    <div class="intro-bloque">
        <p class="texto-destacado">
            Somos un oasis de tranquilidad dedicado a realzar tu belleza natural y renovar tu espíritu. 
            En <strong>AURA BEAUTY & SPA</strong>, creemos que cada persona merece un momento para desconectar y cuidarse.
        </p>
    </div>
    
    <div class="bloque-zigzag">
        <div class="bloque-texto">
            <h3>Nuestra Filosofía</h3>
            <p>Nuestra misión es combinar las técnicas más innovadoras con productos de la más alta calidad en un ambiente sereno y acogedor.</p>
            <blockquote class="cita-aura">"Luce radiante, siéntete tú"</blockquote>
            <p>No es solo nuestro eslogan, es nuestra promesa inquebrantable de calidad.</p>
        </div>
        <div class="bloque-imagen">
            <img src="{{ asset('imagen/sinfoto.jpg') }}" alt="Filosofía Aura">
        </div>
    </div>

    <div class="bloque-zigzag inverso">
        <div class="bloque-texto">
            <h3>Nuestra Historia</h3>
            <p>Desde nuestros inicios, AURA BEAUTY & SPA ha sido más que un spa; es un refugio. Fundado con la visión de crear un espacio de reconexión, hemos crecido gracias a la confianza de quienes nos eligen.</p>
            <p>Nuestra evolución es constante, incorporando tendencias globales sin perder la calidez local que nos caracteriza.</p>
        </div>
        <div class="bloque-imagen">
             <img src="{{ asset('imagen/sinfoto.jpg') }}" alt="Historia Aura">
        </div>
    </div>

    <div class="seccion-valores">
        <h3 class="titulo-centro">¿Por qué elegirnos?</h3>
        
        <div class="valores-grid">
            <div class="valor-card">
                <div class="icono-contenedor">✨</div>
                <h4>Excelencia</h4>
                <p>Profesionales certificados con años de experiencia en el cuidado de la belleza.</p>
            </div>
            
            <div class="valor-card destacado">
                <div class="icono-contenedor">💆‍♀</div>
                <h4>Bienestar</h4>
                <p>Tu relajación y comodidad son nuestra máxima prioridad absoluta.</p>
            </div>
            
            <div class="valor-card">
                <div class="icono-contenedor">🌿</div>
                <h4>Calidad</h4>
                <p>Utilizamos solo productos premium y técnicas de vanguardia.</p>
            </div>
        </div>
    </div>

    <div class="bloque-zigzag">
        <div class="bloque-texto">
            <h3>Nuestro Espacio</h3>
            <p>Cada rincón de AURA ha sido diseñado pensando en tu comodidad. Iluminación cálida, música envolvente y aromas que curan.</p>
            <p>Hemos creado un santuario donde puedes desconectar del estrés diario y sumergirte en una experiencia sensorial completa.</p>
        </div>
        <div class="bloque-imagen">
             <img src="{{ asset('imagen/sinfoto.jpg') }}" alt="Instalaciones Aura">
        </div>
    </div>

    <div class="seccion-compromiso">
        <div class="contenido-compromiso">
            <h3>Nuestro Compromiso Contigo</h3>
            <div class="lista-columnas">
                <ul class="lista-compromisos">
                    <li>Servicios de alta calidad y productos seguros</li>
                    <li>Estándares hospitalarios de higiene</li>
                    <li>Atención 100% personalizada</li>
                </ul>
                <ul class="lista-compromisos">
                    <li>Puntualidad rigurosa en cada cita</li>
                    <li>Escucha activa de tus necesidades</li>
                    <li>Experiencias memorables garantizadas</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="cta-nosotros">
        <div class="cta-contenido">
            <h2>¿Lista para tu transformación?</h2>
            <p>El momento de cuidarte es ahora.</p>
            <a href="{{ route('reservaciones') }}" class="btn-agendar">Agenda tu cita hoy</a>
        </div>
    </div>
</div>

<style>
    /* --- ESTILOS GENERALES --- */
    body {
        background-color: var(--color-fondo);
        overflow-x: hidden;
    }

    .nosotros-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem 4rem 2rem;
    }

    /* --- HEADER --- */
    .header-nosotros {
        text-align: center;
        padding: 4rem 1rem;
        background: linear-gradient(135deg, var(--color-tarjeta) 0%, var(--color-acento-claro) 100%);
        border-radius: 0 0 50% 50% / 20px;
        margin-bottom: 3rem;
    }

    .seccion-titulo {
        font-family: var(--fuente-cursiva);
        font-size: 3.5rem;
        color: var(--color-principal);
        margin: 0;
        font-weight: 300;
    }

    .subtitulo-header {
        font-size: 1.2rem;
        color: var(--color-texto);
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-top: 0.5rem;
        opacity: 0.8;
    }

    /* --- INTRO --- */
    .intro-bloque {
        max-width: 800px;
        margin: 0 auto 5rem auto;
        text-align: center;
    }

    .texto-destacado {
        font-size: 1.3rem;
        line-height: 1.8;
        color: var(--color-texto);
        border-bottom: 2px solid var(--color-acento-claro);
        padding-bottom: 2rem;
    }

    /* --- ZIG-ZAG LAYOUT --- */
    .bloque-zigzag {
        display: flex;
        align-items: center;
        gap: 4rem;
        margin-bottom: 6rem;
    }

    .bloque-zigzag.inverso {
        flex-direction: row-reverse;
    }

    .bloque-texto {
        flex: 1;
    }

    .bloque-imagen {
        flex: 1;
        position: relative;
    }

    .bloque-imagen img {
        width: 100%;
        height: auto;
        border-radius: 20px 0 20px 0;
        box-shadow: 10px 10px 30px rgba(92, 75, 69, 0.15);
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .bloque-imagen:hover img {
        transform: scale(1.02);
    }

    .bloque-texto h3 {
        font-family: var(--fuente-titulos);
        color: var(--color-principal);
        font-size: 2rem;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }
    
    .bloque-texto h3::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 50px;
        height: 3px;
        background-color: var(--color-acento-claro);
    }

    .bloque-texto p {
        font-size: 1.1rem;
        color: var(--color-texto);
        line-height: 1.8;
        margin-bottom: 1.5rem;
        text-align: justify;
    }

    .cita-aura {
        font-family: var(--fuente-cursiva);
        font-size: 1.8rem;
        color: var(--color-principal);
        margin: 2rem 0;
        border-left: 3px solid var(--color-principal);
        padding-left: 1rem;
    }

    /* --- SECCIÓN VALORES (CORREGIDA) --- */
    .seccion-valores {
        margin-bottom: 6rem;
        padding: 3rem;
        background-color: rgba(255,255,255, 0.5);
        border-radius: 30px;
        /* Estructura Vertical: Título arriba, Grid abajo */
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .titulo-centro {
        text-align: center;
        font-family: var(--fuente-titulos);
        color: var(--color-principal);
        font-size: 2.5rem;
        margin-bottom: 3rem;
        width: 100%;
    }

    .valores-grid {
        /* Estructura Horizontal de tarjetas */
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: stretch;
        gap: 2rem;
        width: 100%;
    }

    .valor-card {
        flex: 1;
        background: var(--color-tarjeta);
        padding: 2.5rem;
        border-radius: 15px;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid transparent;
        box-shadow: 0 4px 15px rgba(92, 75, 69, 0.05);
    }

    .valor-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(92, 75, 69, 0.15);
        border-color: var(--color-acento-claro);
    }

    .icono-contenedor {
        font-size: 3.5rem;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.8) 100%);
        width: 80px;
        height: 80px;
        line-height: 80px;
        border-radius: 50%;
        margin: 0 auto 1.5rem auto;
    }

    .valor-card h4 {
        color: var(--color-principal);
        font-size: 1.4rem;
        margin-bottom: 1rem;
    }

    /* --- COMPROMISO --- */
    .seccion-compromiso {
        background: var(--color-tarjeta);
        padding: 4rem;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.03);
        margin-bottom: 6rem;
    }

    .seccion-compromiso h3 {
        text-align: center;
        color: var(--color-principal);
        font-family: var(--fuente-titulos);
        font-size: 2rem;
        margin-bottom: 2rem;
    }

    .lista-columnas {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .lista-compromisos {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .lista-compromisos li {
        margin-bottom: 1.2rem;
        padding-left: 2rem;
        position: relative;
        font-size: 1.1rem;
        color: var(--color-texto);
    }

    .lista-compromisos li::before {
        content: "✦";
        position: absolute;
        left: 0;
        color: var(--color-principal);
    }

    /* --- CTA --- */
    .cta-nosotros {
        position: relative;
        padding: 4rem 2rem;
        text-align: center;
        background: var(--color-principal);
        border-radius: 20px;
        color: #fff;
        overflow: hidden;
    }

    .cta-nosotros::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
        pointer-events: none;
    }

    .cta-contenido {
        position: relative;
        z-index: 2;
    }

    .cta-nosotros h2 {
        font-family: var(--fuente-cursiva);
        font-size: 3rem;
        margin-bottom: 0.5rem;
        font-weight: 300;
    }

    .cta-nosotros p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .btn-agendar {
        display: inline-block;
        background-color: #fff;
        color: var(--color-principal);
        padding: 1rem 3.5rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: bold;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .btn-agendar:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        background-color: var(--color-acento-claro);
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 900px) {
        .bloque-zigzag, 
        .bloque-zigzag.inverso {
            flex-direction: column;
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .bloque-imagen {
            order: -1;
            width: 100%;
        }

        .valores-grid {
            flex-direction: column; /* Celular: Tarjetas verticales */
        }

        .lista-columnas {
            grid-template-columns: 1fr;
        }

        .seccion-titulo {
            font-size: 2.5rem;
        }

        .seccion-compromiso {
            padding: 2rem;
        }
    }
</style>
@endsection