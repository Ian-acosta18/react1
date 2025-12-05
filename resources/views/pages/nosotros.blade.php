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

    <!-- NUEVA SECCIÓN: Nuestra Historia -->
    <div class="seccion-historia">
        <h3>Nuestra Historia</h3>
        <p>Desde nuestros inicios, AURA BEAUTY & SPA ha sido más que un spa; es un refugio donde la belleza y el bienestar se encuentran. Fundado con la visión de crear un espacio donde cada cliente pueda reconectar consigo mismo, hemos crecido gracias a la confianza de quienes nos eligen día a día.</p>
        <p>Nuestro compromiso con la excelencia nos ha llevado a estar en constante evolución, incorporando las últimas tendencias en tratamientos de belleza mientras mantenemos la calidez y atención personalizada que nos caracteriza.</p>
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


    <!-- NUEVA SECCIÓN: Nuestro Espacio -->
    <div class="seccion-espacio">
        <h3>Nuestro Espacio</h3>
        <p>Cada rincón de AURA ha sido diseñado pensando en tu comodidad. Desde la iluminación cálida hasta la música relajante, pasando por nuestros espacios amplios y privados, todo está pensado para que te sientas en casa.</p>
        <p>Creemos que el ambiente es tan importante como el tratamiento mismo. Por eso, hemos creado un santuario donde puedes desconectar del estrés diario y sumergirte en una experiencia sensorial completa.</p>
    </div>

    <!-- NUEVA SECCIÓN: Nuestro Compromiso -->
    <div class="seccion-compromiso">
        <h3>Nuestro Compromiso</h3>
        <p>En AURA BEAUTY & SPA nos comprometemos a:</p>
        <ul class="lista-compromisos">
            <li>Ofrecer servicios de la más alta calidad con productos seguros y efectivos</li>
            <li>Mantener los más altos estándares de higiene y seguridad</li>
            <li>Brindar atención personalizada adaptada a tus necesidades específicas</li>
            <li>Respetar tu tiempo con puntualidad en cada cita</li>
            <li>Escuchar tus inquietudes y superar tus expectativas</li>
            <li>Crear experiencias memorables que te hagan volver</li>
        </ul>
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
        text-align: justify;
    }
    
    .seccion-filosofia em {
        color: var(--color-principal); /* Color principal de AURA */
        font-weight: 600;
        font-style: normal;
    }

    /* NUEVOS ESTILOS PARA SECCIONES ADICIONALES */
    .seccion-historia,
    .seccion-equipo,
    .seccion-espacio,
    .seccion-compromiso {
        margin-bottom: 3rem;
        padding: 2rem;
        background: var(--color-tarjeta);
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(92, 75, 69, 0.05);
    }

    .seccion-historia h3,
    .seccion-equipo h3,
    .seccion-espacio h3,
    .seccion-compromiso h3 {
        color: var(--color-principal);
        font-family: var(--fuente-titulos);
        font-size: 1.8rem;
        margin-bottom: 1rem;
        text-align: center;
    }

    .seccion-historia p,
    .seccion-equipo p,
    .seccion-espacio p,
    .seccion-compromiso p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--color-texto);
        text-align: justify;
        margin-bottom: 1rem;
    }

    .seccion-historia p:last-child,
    .seccion-equipo p:last-child,
    .seccion-espacio p:last-child {
        margin-bottom: 0;
    }

    .lista-compromisos {
        list-style: none;
        padding: 0;
        margin-top: 1.5rem;
    }

    .lista-compromisos li {
        font-size: 1.05rem;
        line-height: 1.8;
        color: var(--color-texto);
        padding: 0.8rem 0 0.8rem 2.5rem;
        position: relative;
        text-align: left;
    }

    .lista-compromisos li:before {
        content: "✓";
        position: absolute;
        left: 0.5rem;
        color: var(--color-principal);
        font-weight: bold;
        font-size: 1.3rem;
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

        .seccion-historia,
        .seccion-equipo,
        .seccion-espacio,
        .seccion-compromiso {
            padding: 1.5rem;
        }

        .seccion-historia h3,
        .seccion-equipo h3,
        .seccion-espacio h3,
        .seccion-compromiso h3 {
            font-size: 1.5rem;
        }

        .seccion-historia p,
        .seccion-equipo p,
        .seccion-espacio p,
        .seccion-compromiso p {
            font-size: 1rem;
            text-align: justify;
        }

        .lista-compromisos li {
            font-size: 0.95rem;
            padding-left: 2rem;
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