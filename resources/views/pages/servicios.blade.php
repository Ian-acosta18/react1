@extends('layouts.app')

@section('content')
<h2 class="seccion-titulo">Lista de precios</h2>

<div class="servicios-contenedor">
    
    @foreach ($categorias as $categoria)

    <section class="servicio-categoria">
        <h3>{{ $categoria->nombre_categoria }}</h3> 
        
        <div class="servicios-grid">
            
            @foreach ($categoria->servicios as $servicio)
                <div class="servicio-tarjeta">
                    @if($servicio->imagen)
                    <div class="servicio-img-wrapper" style="margin-bottom: 10px; text-align: center;">
                    <img src="{{ asset($servicio->imagen) }}" 
                     alt="{{ $servicio->nombre_servicio }}" 
                     style="max-width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
                    </div>
                    @endif
                    <div class="info">
                        <h4>{{ $servicio->nombre_servicio }}</h4> 
                        
                        {{-- Opcional: Para el texto "Desde". Requiere lógica/campo en DB. --}}
                        {{-- @if (isset($servicio->es_desde) && $servicio->es_desde)
                            <span>Desde</span>
                        @endif --}}

                    </div>
                    
                    {{-- Muestra el precio formateado (ej: $150) --}}
                    <div class="precio">${{ number_format($servicio->precio, 0, ',', '.') }}</div>
                </div>
            @endforeach
            
        </div>
    </section>

    @endforeach

</div>
@endsection