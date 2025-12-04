@extends('layouts.app')

@section('content')

<h2 class="seccion-titulo">Nosotros</h2>

<div class="nosotros-contenido-nuevo">
    <div class="intro-nosotros">
        <p class="texto-destacado">Somos un oasis de tranquilidad dedicado a realzar tu belleza natural y renovar tu espíritu. En AURA BEAUTY & SPA, creemos que cada persona merece un momento para desconectar y cuidarse.</p>
    </div>
    
    <div class="seccion-filosofia">
        <h3>Nuestra Filosofía</h3>
        <p>Nuestra misión es combinar las técnicas más innovadoras con productos de la más alta calidad en un ambiente sereno y acogedor. <em>"Luce radiante, siéntete tú"</em> no es solo nuestro eslogan, es nuestra promesa.</p>
    </div>

    <div class="valores-grid">
        <div class="valor-card">
            <div class="icono">✨</div>
            <h4>Excelencia</h4>
            <p>Profesionales certificados con años de experiencia en el cuidado de la belleza.</p>
        </div>
        
        <div class="valor-card">
            <div class="icono">💆‍♀</div>
            <h4>Bienestar</h4>
            <p>Tu relajación y comodidad son nuestra máxima prioridad.</p>
        </div>
        
        <div class="valor-card">
            <div class="icono">🌿</div>
            <h4>Calidad</h4>
            <p>Utilizamos solo productos premium y técnicas de vanguardia.</p>
        </div>
    </div>

    <div class="cta-nosotros">
        <p>¿Lista para tu transformación?</p>
        <a href="{{ route('reservaciones') }}" class="btn-agendar">Agenda tu cita</a>
    </div>
</div>

<style>
    /* * Esta regla anulará el fondo global solo para esta página 
     * si se usa en este archivo.
     */
    body {
        background-color: var(--color-fondo); /* Fondo cálido de AURA */
    }

    /* * Este .seccion-titulo anulará el .seccion-titulo global de style.css
     * si se usa aquí, dándole el fondo degradado que pediste.
     */
    .seccion-titulo {
        /* AJUSTE CLAVE 1: Usamos el degradado de AURA para el FONDO. */
        background: linear-gradient(135deg, var(--color-tarjeta) 0%, var(--color-acento-claro) 100%);
        
        /* AJUSTE CLAVE 2: Usamos el color de texto de AURA. */
        color: var(--color-texto); 
        
        padding: 2rem;
        margin: 0 0 2rem 0;
        text-align: center;
        font-family: var(--fuente-cursiva); /* Fuente de AURA */
        font-size: 3rem; 
        font-weight: 300;
        letter-spacing: 2px;
    }
    
    .nosotros-contenido-nuevo {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem;
    }
    
    .intro-nosotros {
        margin-bottom: 2.5rem;
    }
    
    .texto-destacado {
        font-size: 1.2rem;
        line-height: 1.8;
        color: var(--color-texto);
        text-align: center;
        padding: 1.5rem;
        /* Fondo con degradado suave de la paleta AURA */
        background: linear-gradient(135deg, var(--color-tarjeta) 0%, var(--color-acento-claro) 100%); 
        border-radius: 10px;
        /* Borde con el color principal de AURA */
        border-left: 4px solid var(--color-principal); 
    }
    
    .seccion-filosofia {
        margin-bottom: 3rem;
        padding: 2rem;
        background: var(--color-tarjeta);
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(92, 75, 69, 0.05); /* Sombra cálida */
    }
    
    .seccion-filosofia h3 {
        color: var(--color-principal); /* Color principal de AURA */
        font-family: var(--fuente-titulos); /* Fuente de AURA */
        font-size: 1.8rem;
        margin-bottom: 1rem;
        text-align: center;
    }
    
    .seccion-filosofia p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--color-texto);
        text-align: center;
    }
    
    .seccion-filosofia em {
        color: var(--color-principal); /* Color principal de AURA */
        font-weight: 600;
        font-style: normal;
    }
    
    .valores-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .valor-card {
        background: var(--color-tarjeta);
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(92, 75, 69, 0.08); /* Sombra cálida */
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .valor-card:hover {
        transform: translateY(-5px);
        /* Sombra con el color principal de AURA */
        box-shadow: 0 6px 20px rgba(var(--color-principal-rgb), 0.2); 
    }
    
    .icono {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    .valor-card h4 {
        color: var(--color-principal); /* Color principal de AURA */
        font-family: var(--fuente-titulos); /* Fuente de AURA */
        font-size: 1.3rem;
        margin-bottom: 0.8rem;
    }
    
    .valor-card p {
        color: var(--color-texto);
        opacity: 0.9;
        line-height: 1.6;
        font-size: 0.95rem;
    }
    
    .cta-nosotros {
        /* Fondo con el color principal de AURA */
        background: var(--color-principal); 
        padding: 2.5rem;
        border-radius: 15px;
        text-align: center;
        color: white; /* Texto blanco para contraste */
    }
    
    .cta-nosotros p {
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 300;
    }
    
    .btn-agendar {
        display: inline-block;
        background: var(--color-tarjeta); /* Botón blanco */
        color: var(--color-principal); /* Texto con color principal */
        font-family: var(--fuente-titulos); /* Fuente de AURA */
        padding: 1rem 3rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .btn-agendar:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        background: var(--color-acento-claro); /* Hover con fondo beige claro */
    }
    
    @media (max-width: 768px) {
        .nosotros-contenido-nuevo {
            padding: 1rem;
        }
        
        .seccion-titulo {
            font-size: 2.2rem; /* Ajustado para móvil */
            padding: 1.5rem;
        }
        
        .texto-destacado {
            font-size: 1rem;
            padding: 1rem;
        }
        
        .valores-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .cta-nosotros p {
            font-size: 1.2rem;
        }
    }
</style>
@endsection