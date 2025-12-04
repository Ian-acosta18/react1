@extends('layouts.app')

@section('content')

{{-- 
    Tu bloque de estilos CSS (sin cambios, ya que solicitaste no tocarlos) 
--}}
<style>
    /* Importación de fuentes */
    @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Lato:wght@300;400;700&family=Playfair+Display:wght@400;600;700&display=swap');

    :root {
        --color-fondo: #FDFBF7;
        --color-texto: #5c4b45;
        --color-principal: #B98D7B;
        --color-tarjeta: #FFFFFF;
        --color-acento-claro: #F9F3EC;
        
        --fuente-titulos: 'Playfair Display', serif;
        --fuente-cuerpo: 'Lato', sans-serif;
        --fuente-cursiva: 'Dancing Script', cursive;

        --color-principal-rgb: 185, 141, 123;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: var(--fuente-cuerpo);
        background-color: var(--color-fondo);
        color: var(--color-texto);
        line-height: 1.6;
    }

    /* Estilos Generales de Layout (Header/Footer/Main) */
    main {
        padding: 2rem 1rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    header {
        background: #fff;
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid var(--color-acento-claro);
    }

    header .logo h1 {
        font-family: var(--fuente-titulos);
        color: var(--color-principal);
        font-size: 2.5rem;
        margin: 0;
        line-height: 1;
    }

    header .logo h2 {
        font-family: var(--fuente-titulos);
        color: var(--color-principal);
        font-size: 1rem;
        font-weight: 400;
        letter-spacing: 2px;
        margin: 0;
    }

    header nav ul {
        list-style: none;
        display: flex;
        gap: 1.5rem;
    }

    header nav a {
        text-decoration: none;
        color: var(--color-texto);
        font-weight: 400;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    header nav a:hover {
        color: var(--color-principal);
    }

    header nav .btn-reserva {
        background-color: var(--color-principal);
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    header nav .btn-reserva:hover {
        background-color: #a57c6b;
        color: #fff;
    }

    footer {
        text-align: center;
        padding: 2rem;
        background-color: var(--color-acento-claro);
        color: var(--color-texto);
        margin-top: 2rem;
    }

    footer .footer-content p:first-child {
        font-family: var(--fuente-cursiva);
        font-size: 1.8rem;
        color: var(--color-principal);
        margin-bottom: 1rem;
    }

    footer .social-links {
        margin-bottom: 1rem;
    }

    footer .social-links a {
        margin: 0 0.5rem;
        text-decoration: none;
        color: var(--color-texto);
    }

    footer .social-links a:hover {
        color: var(--color-principal);
    }

    .seccion-titulo {
        font-family: var(--fuente-cursiva);
        font-size: 3.5rem;
        color: var(--color-principal);
        text-align: center;
        margin-bottom: 2rem;
    }

    /* --- Estilos Específicos del Formulario --- */
    .formulario {
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        background: var(--color-tarjeta);
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .form-grupo {
        margin-bottom: 1.5rem;
    }

    .form-grupo label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 400;
    }

    .form-grupo input,
    .form-grupo select,
    .form-grupo textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--color-acento-claro);
        border-radius: 5px;
        font-family: var(--fuente-cuerpo);
        font-size: 1rem;
    }
    
    /* Estilo para los errores de validación */
    .error-message {
        color: #e3342f; 
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    /* IMPORTANTE: Corrección para que los checkboxes no se estiren */
    .form-grupo input[type="checkbox"] {
        width: auto;
        margin-right: 10px;
    }

    .form-grupo input:focus,
    .form-grupo select:focus,
    .form-grupo textarea:focus {
        outline: none;
        border-color: var(--color-principal);
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: 0.75rem;
        background-color: var(--color-principal);
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        font-family: var(--fuente-titulos);
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #a57c6b;
    }
</style>
{{-- Fin del bloque de estilos --}}


<h2 class="seccion-titulo">Agendar Cita</h2>
<p style="text-align: center; margin-top: -2rem; margin-bottom: 2rem;">Completa el formulario y nos pondremos en contacto para confirmar.</p>

<form action="{{ route('reserva.store') }}" method="POST" class="formulario">
    @csrf
    
    {{-- CAMPOS DE NOMBRE Y APELLIDOS --}}
    <div class="form-grupo">
        <label for="nombres">Nombre(s):</label>
        <input type="text" id="nombres" name="nombres" value="{{ old('nombres') }}" required>
        @error('nombres') <div class="error-message">{{ $message }}</div> @enderror
    </div>

    <div class="form-grupo">
        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required>
        @error('apellido_paterno') <div class="error-message">{{ $message }}</div> @enderror
    </div>

    <div class="form-grupo">
        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}" required>
        @error('apellido_materno') <div class="error-message">{{ $message }}</div> @enderror
    </div>
    
    {{-- CAMPO CORREO --}}
    <div class="form-grupo">
        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required>
        @error('correo') <div class="error-message">{{ $message }}</div> @enderror
    </div>
    
    {{-- CAMPO TELÉFONO --}}
    <div class="form-grupo">
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
        @error('telefono') <div class="error-message">{{ $message }}</div> @enderror
    </div>
    
    {{-- CANTIDAD DE SERVICIOS --}}
    <div class="form-grupo">
        <label for="cantidad_servicios">¿Cuántos servicios deseas?</label>
        <select id="cantidad_servicios" name="cantidad_servicios" required>
            <option value="">-- Selecciona cantidad --</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ old('cantidad_servicios') == $i ? 'selected' : '' }}>{{ $i }} servicio(s)</option>
            @endfor
        </select>
    </div>
    
    {{-- BLOQUE DINÁMICO DE CHECKBOXES --}}
    <div class="form-grupo" id="servicios-container" style="display: {{ old('cantidad_servicios') ? 'block' : 'none' }};">
        <label>Servicios de Interés:</label>
        <p style="font-size: 0.9em; color: #666; margin-top: 0.5rem;">Selecciona hasta <span id="max-servicios">{{ old('cantidad_servicios', 0) }}</span> servicio(s)</p>
        
        @if (isset($servicios) && count($servicios) > 0)
            {{-- Agrupa los servicios por el nombre de la categoría para replicar la estructura --}}
            @php
                // Se asume que $servicios tiene la relación 'categoria' cargada (eager loading)
                $serviciosAgrupados = $servicios->groupBy(function($item) {
            return $item->categoria ? $item->categoria->nombre_categoria : 'Otros';
        });
        @endphp
            
            @foreach ($serviciosAgrupados as $nombreCategoria => $serviciosLista)
                <div style="margin-top: 1rem;">
                    <strong style="display: block; margin-bottom: 0.5rem;">{{ $nombreCategoria }}</strong>
                    <div style="margin-left: 1rem;">
                        @foreach ($serviciosLista as $servicio)
                            <label style="display: block; margin-bottom: 0.5rem;">
                                {{-- Campo checkbox dinámico --}}
                                <input type="checkbox" 
                                       name="servicios[]" 
                                       value="{{ $servicio->nombre_servicio }}" 
                                       class="servicio-checkbox"
                                       {{ is_array(old('servicios')) && in_array($servicio->nombre_servicio, old('servicios')) ? 'checked' : '' }}>
                                {{ $servicio->nombre_servicio }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach
            
            {{-- Opción "Otro" --}}
            <div style="margin-top: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem;">
                    <input type="checkbox" name="servicios[]" value="Otro" class="servicio-checkbox" {{ is_array(old('servicios')) && in_array('Otro', old('servicios')) ? 'checked' : '' }}>
                    Otro (Especificar en mensaje adicional)
                </label>
            </div>
            
            {{-- Muestra error de validación para el campo 'servicios' (el array) --}}
            @error('servicios') <div class="error-message">{{ $message }}</div> @enderror
            
        @else
            <p>No hay servicios disponibles para reservar. Por favor, inténtalo más tarde.</p>
        @endif
    </div>
    
    {{-- FECHA Y HORA --}}
    <div class="form-grupo">
        <label for="fecha">Fecha Deseada:</label>
        <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
        @error('fecha') <div class="error-message">{{ $message }}</div> @enderror
    </div>
    
    <div class="form-grupo">
        <label for="hora">Hora Deseada:</label>
        <input type="time" id="hora" name="hora" value="{{ old('hora') }}" required>
        @error('hora') <div class="error-message">{{ $message }}</div> @enderror
    </div>
    
    {{-- MENSAJE ADICIONAL --}}
    <div class="form-grupo">
        <label for="mensaje">Mensaje Adicional:</label>
        <textarea id="mensaje" name="mensaje" rows="4">{{ old('mensaje') }}</textarea>
        @error('mensaje') <div class="error-message">{{ $message }}</div> @enderror
    </div>
    
    <button type="submit" class="btn-submit">Enviar Solicitud</button>
</form>

{{-- 
    Tu script de JavaScript (sin cambios, necesario para la lógica de los checkboxes) 
--}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cantidadSelect = document.getElementById('cantidad_servicios');
    const serviciosContainer = document.getElementById('servicios-container');
    const checkboxes = document.querySelectorAll('.servicio-checkbox');
    const maxServiciosSpan = document.getElementById('max-servicios');
    
    // Inicialización de maxServicios basado en el valor de old() si existe
    let maxServicios = parseInt(cantidadSelect.value) || 0;
    maxServiciosSpan.textContent = maxServicios;

    // Mostrar/ocultar checkboxes según la cantidad seleccionada
    cantidadSelect.addEventListener('change', function() {
        const cantidad = parseInt(this.value);
        
        if (cantidad > 0) {
            maxServicios = cantidad;
            maxServiciosSpan.textContent = cantidad;
            serviciosContainer.style.display = 'block';
            
            // Desmarcar todos los checkboxes al cambiar la cantidad
            checkboxes.forEach(cb => cb.checked = false);
        } else {
            serviciosContainer.style.display = 'none';
            maxServicios = 0;
            maxServiciosSpan.textContent = 0;
        }
    });
    
    // Limitar la cantidad de checkboxes seleccionados
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedCount = document.querySelectorAll('.servicio-checkbox:checked').length;
            
            if (maxServicios > 0 && checkedCount > maxServicios) {
                this.checked = false;
                alert(`Solo puedes seleccionar hasta ${maxServicios} servicio(s).`);
            }
        });
    });
    
    // Validar antes de enviar el formulario
    document.querySelector('.formulario').addEventListener('submit', function(e) {
        const checkedCount = document.querySelectorAll('.servicio-checkbox:checked').length;
        const cantidadSeleccionada = parseInt(cantidadSelect.value);
        
        if (cantidadSeleccionada > 0 && checkedCount === 0) {
            e.preventDefault();
            alert('Por favor selecciona al menos un servicio de la lista.');
            return false;
        }
        
        if (cantidadSeleccionada > 0 && checkedCount !== cantidadSeleccionada) {
            e.preventDefault();
            alert(`Debes seleccionar exactamente ${cantidadSeleccionada} servicio(s).`);
            return false;
        }
    });
});
</script>
@endsection