@extends('layouts.app')

@section('content')

{{-- 1. HERO BOUTIQUE --}}
<section class="hero-boutique fade-in">
    <div class="hero-boutique-content">
        <span class="etiqueta-destacada">Aura Home Care</span>
        <h1>Boutique Exclusiva</h1>
        <p>Lleva la magia del spa contigo. Productos seleccionados por nuestros expertos para prolongar tu bienestar en casa.</p>
    </div>
</section>

{{-- 3. GRID DE PRODUCTOS --}}
<div class="productos-container">
    <div class="productos-grid">
        @if(isset($productos) && count($productos) > 0)
            @foreach($productos as $producto)
                <div class="producto-card-premium">
                    <div class="img-wrapper">
                        {{-- Imagen del producto --}}
                        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}">
                        
                        {{-- Etiqueta flotante decorativa --}}
                        <span class="badge-nuevo">Recomendado</span>
                    </div>
                    
                    <div class="info-wrapper">
                        <div class="info-top">
                            <h3>{{ $producto->nombre }}</h3>
                            {{-- Usamos CSS para cortar el texto si es muy largo --}}
                            <p class="descripcion">{{ $producto->descripcion }}</p>
                        </div>
                        
                        <div class="info-bottom">
                            <span class="precio">${{ number_format($producto->precio, 2) }}</span>
                            {{-- Botón con icono --}}
                            <a href="{{ route('contacto') }}" class="btn-comprar-icon">
                                🛍️ Adquirir
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="sin-resultados">
                <p>Estamos actualizando nuestro catálogo exclusivo. Vuelve pronto.</p>
            </div>
        @endif
    </div>
</div>

{{-- 4. BANNER DE ASESORÍA (CTA FINAL) --}}
<section class="asesoria-banner">
    <div class="asesoria-content">
        <h2>¿No sabes qué necesita tu piel?</h2>
        <p>Nuestras especialistas pueden realizarte un diagnóstico gratuito en tu próxima visita para recomendarte la rutina ideal.</p>
        <a href="{{ route('reservaciones') }}" class="link-asesoria">Agendar Diagnóstico &rarr;</a>
    </div>
</section>

@endsection