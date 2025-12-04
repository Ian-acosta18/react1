@extends('layouts.app')

@section('content')

<h2 class="seccion-titulo">Contacto</h2>

{{-- AVISO DE ÉXITO --}}
@if (session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 1rem; margin: 1rem auto; max-width: 800px; text-align: center; border-radius: 5px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
@endif

<div class="contacto-layout">
    
    <div class="contacto-mapa-info">
        <h3 class="seccion-subtitulo">Visítanos</h3>
        <p><strong>Dirección:</strong> 72640, Supermanzana km97, Cumbres Residencial, 72640 Cuanalá, Pue.</p>
        <p><strong>Teléfono:</strong> +52 2223963481</p>
        <p><strong>Horarios:</strong> Lunes a Sábado de 8:00 AM a 8:00 PM</p>
        
        <div class="contacto-imagen-decorativa">
            <img src="{{ asset('imagen/spa_uñas_aura.jpg') }}" alt="Manicura profesional en Aura Spa">
        </div>
    </div>

    <div class="contacto-formulario">
        <h3 class="seccion-subtitulo">Pregúntanos</h3>
        
        {{-- CORRECCIÓN AQUÍ: action apunta a la ruta correcta --}}
        <form action="{{ route('contacto.store') }}" method="POST">
            @csrf
            <div class="form-grupo">
                <label for="nombre-contacto" class="sr-only">Nombre</label>
                <input type="text" id="nombre-contacto" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="form-grupo">
                <label for="email-contacto" class="sr-only">Correo Electrónico</label>
                {{-- CORRECCIÓN: name="email" para coincidir con la base de datos --}}
                <input type="email" id="email-contacto" name="email" placeholder="Correo Electrónico" required>
            </div>
            <div class="form-grupo">
                <label for="mensaje-contacto" class="sr-only">Comentarios</label>
                <textarea id="mensaje-contacto" name="mensaje" rows="6" placeholder="Comentarios" required></textarea>
            </div>
            <button type="submit" class="btn-shiner">Enviar</button>
        </form>

        <div class="mapa-responsive">
           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30159.621776358854!2d-98.34237449122944!3d19.109729895125223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cfcf13dce86f95%3A0x60a376afca7a7353!2sAura%20Beauty%26Spa!5e0!3m2!1ses-419!2smx!4v1763013387795!5m2!1ses-419!2smx" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

</div>

@endsection