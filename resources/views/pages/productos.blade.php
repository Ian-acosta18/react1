@extends('layouts.app')

@section('content')

{{-- Estilos específicos para la sección de productos --}}
<style>
    /* Reutilizamos estilos del Hero pero ajustados */
    .hero-inicio {
        text-align: center;
        padding: 3rem 1rem;
        background-color: var(--color-acento-claro);
        margin-bottom: 3rem;
        border-radius: 0 0 15px 15px;
    }
    
    .hero-contenido-inicio h1 {
        font-family: var(--fuente-titulos);
        color: var(--color-texto);
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    /* Grid de Productos */
    .productos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        padding: 0 1rem 3rem 1rem;
    }

    .producto-card {
        background: var(--color-tarjeta);
        border: 1px solid var(--color-acento-claro);
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .producto-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(92, 75, 69, 0.15);
    }

    .producto-imagen {
        width: 100%;
        height: 250px;
        overflow: hidden;
        background-color: #f0f0f0;
        position: relative;
    }

    .producto-imagen img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Asegura que la imagen llene el cuadro sin deformarse */
        transition: transform 0.5s ease;
    }

    .producto-card:hover .producto-imagen img {
        transform: scale(1.05);
    }

    .producto-info {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .producto-info h3 {
        font-family: var(--fuente-titulos);
        font-size: 1.3rem;
        color: var(--color-texto);
        margin-bottom: 0.5rem;
    }

    .producto-info p {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    .producto-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto; /* Empuja el footer al fondo de la tarjeta */
    }

    .precio {
        font-size: 1.2rem;
        font-weight: bold;
        color: var(--color-principal);
    }

    .btn-comprar {
        background-color: var(--color-texto);
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: background 0.3s ease;
    }

    .btn-comprar:hover {
        background-color: var(--color-principal);
    }
</style>

<section class="hero-inicio">
    <div class="hero-contenido-inicio">
        <h1>Nuestra Colección Exclusiva</h1>
        <p>Descubre productos seleccionados para complementar tu belleza y bienestar.</p>
        <a href="{{ route('reservaciones') }}" class="btn-inicio-reserva">Agenda tu Cita</a>
    </div>
</section>
<div class="productos-container">
    <h2 class="seccion-titulo">Productos Disponibles</h2>
    
    <div class="productos-grid">
        @if(isset($productos) && count($productos) > 0)
            @foreach($productos as $producto)
                <div class="producto-card">
                    <div class="producto-imagen">
                        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}">
                    </div>
                    <div class="producto-info">
                        <h3>{{ $producto->nombre }}</h3>
                        <p>{{ $producto->descripcion }}</p>
                        
                        <div class="producto-footer">
                            <span class="precio">${{ number_format($producto->precio, 2) }}</span>
                            <a href="{{ route('contacto') }}" class="btn-comprar">Me interesa</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p style="text-align: center; grid-column: 1/-1;">No hay productos disponibles en este momento.</p>
        @endif
    </div>
</div>

@endsection