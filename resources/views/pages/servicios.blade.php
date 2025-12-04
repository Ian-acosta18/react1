@extends('layouts.app')

@section('content')
<section class="seccion-servicios" style="padding: 50px 0; background-color: #f9f9f9;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="font-family: 'Playfair Display', serif; color: #B98D7B; font-size: 2.5rem;">Nuestros Servicios</h2>
            <p class="lead text-muted">Explora nuestra variedad de tratamientos diseñados para ti</p>
        </div>

        {{-- BUCLE PRINCIPAL: Recorremos las CATEGORÍAS --}}
        @foreach ($categorias as $categoria)
            
            {{-- Solo mostramos la categoría si tiene servicios registrados --}}
            @if($categoria->servicios->count() > 0)
                <div class="categoria-wrapper mb-5">
                    <h3 class="mb-4 pb-2 border-bottom" style="color: #5c4b45; font-family: 'Playfair Display', serif;">
                        {{ $categoria->nombre_categoria }}
                    </h3>

                    <div class="row">
                        {{-- BUCLE SECUNDARIO: Recorremos los SERVICIOS de esa categoría --}}
                        @foreach ($categoria->servicios as $servicio)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm border-0 serv-card">
                                    
                                    {{-- IMAGEN DEL SERVICIO --}}
                                    <div style="height: 220px; overflow: hidden; position: relative;">
                                        @if($servicio->imagen != "" && file_exists(public_path($servicio->imagen)))
                                            <img src="{{ asset($servicio->imagen) }}" 
                                                 alt="{{ $servicio->nombre_servicio }}" 
                                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                                        @else
                                            {{-- Imagen por defecto si no tiene foto --}}
                                            <img src="{{ asset('imagen/sinfoto.jpg') }}" 
                                                 alt="Sin imagen" 
                                                 style="width: 100%; height: 100%; object-fit: cover; opacity: 0.6;">
                                        @endif
                                    </div>

                                    {{-- INFORMACIÓN --}}
                                    <div class="card-body text-center d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title font-weight-bold" style="color: #5c4b45;">
                                                {{ $servicio->nombre_servicio }}
                                            </h5>
                                            <hr style="width: 50px; margin: 10px auto; border-color: #B98D7B;">
                                        </div>

                                        <div>
                                            <p class="card-text fw-bold my-2" style="font-size: 1.3rem; color: #B98D7B;">
                                                ${{ number_format($servicio->precio, 2) }}
                                            </p>
                                            
                                            <a href="{{ route('reservaciones') }}" class="btn btn-dark btn-sm mt-2" style="border-radius: 20px; padding: 5px 20px; background-color: #B98D7B; border:none;">
                                                Reservar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        @endforeach

        {{-- Mensaje si no hay nada en la BD --}}
        @if($categorias->isEmpty())
            <div class="alert alert-warning text-center">
                No hay servicios disponibles en este momento.
            </div>
        @endif

    </div>
</section>

{{-- Estilo extra para el hover de las imágenes --}}
<style>
    .serv-card:hover img {
        transform: scale(1.05);
    }
</style>
@endsection