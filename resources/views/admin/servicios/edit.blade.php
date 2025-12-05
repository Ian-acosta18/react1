@extends('layouts.app')

@section('content')

{{-- Estilos específicos para esta vista (Incrustados para no tocar tu CSS global) --}}
<style>
    /* Fondo suave para el área de edición */
    .edit-wrapper {
        background-color: #fdfbf9;
        padding: 4rem 0;
        min-height: 80vh;
    }

    /* Tarjeta principal del formulario */
    .card-custom {
        background: #fff;
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(185, 141, 123, 0.15); /* Sombra color marca muy suave */
        overflow: hidden;
    }

    .card-header-custom {
        background-color: #B98D7B; /* Tu color principal */
        color: white;
        padding: 1.5rem;
        text-align: center;
    }

    .card-header-custom h2 {
        margin: 0;
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        letter-spacing: 1px;
    }

    .card-body-custom {
        padding: 2.5rem;
    }

    /* Estilos de etiquetas e inputs */
    .form-label-custom {
        font-family: 'Lato', sans-serif;
        color: #5c4b45;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control-custom {
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: 0.8rem 1rem;
        font-family: 'Lato', sans-serif;
        font-size: 1rem;
        color: #5c4b45;
        transition: all 0.3s ease;
        width: 100%;
        background-color: #fafafa;
    }

    .form-control-custom:focus {
        border-color: #B98D7B;
        background-color: #fff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(185, 141, 123, 0.1);
    }

    /* Imagen */
    .img-preview-container {
        border: 2px dashed #B98D7B;
        padding: 10px;
        border-radius: 8px;
        display: inline-block;
        margin-bottom: 10px;
        background: #fff;
    }

    .img-preview {
        border-radius: 4px;
        object-fit: cover;
    }

    /* Botones */
    .btn-custom-primary {
        background-color: #B98D7B;
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 30px; /* Botones redondeados modernos */
        font-family: 'Lato', sans-serif;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: transform 0.2s, background-color 0.3s;
        cursor: pointer;
        display: inline-block;
    }

    .btn-custom-primary:hover {
        background-color: #a07665;
        transform: translateY(-2px);
    }

    .btn-custom-secondary {
        background-color: transparent;
        color: #888;
        border: 1px solid #ddd;
        padding: 0.8rem 2rem;
        border-radius: 30px;
        font-family: 'Lato', sans-serif;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-block;
        margin-left: 10px;
    }

    .btn-custom-secondary:hover {
        background-color: #f0f0f0;
        color: #555;
    }

    /* Select */
    select.form-control-custom {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23B98D7B%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 0.65em auto;
    }
</style>

<div class="edit-wrapper">
    <div class="container" style="max-width: 800px;">
        
        <div class="card-custom">
            {{-- Encabezado de la tarjeta --}}
            <div class="card-header-custom">
                <h2>Editar Servicio</h2>
                <p style="margin:0; font-family: 'Lato', sans-serif; font-size: 0.9rem; opacity: 0.9;">Modifica los detalles para mantener tu catálogo actualizado</p>
            </div>

            <div class="card-body-custom">
                {{-- Mensajes de error --}}
                @if (count($errors) > 0)
                    <div class="alert alert-danger" style="border-radius: 8px; font-family: 'Lato'; font-size: 0.9rem;">
                        <strong style="display:block; margin-bottom:5px;">Ups! Algo salió mal:</strong>
                        <ul style="margin-bottom: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error) 
                                <li>{{ $error }}</li> 
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulario: La acción y los nombres de inputs se mantienen INTÁCTOS --}}
                <form action="{{ route('admin.servicios.actualizar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $servicio->id }}">

                    <div class="mb-4">
                        <label class="form-label-custom">Nombre del Servicio</label>
                        <input type="text" name="nombre_servicio" class="form-control-custom" value="{{ $servicio->nombre_servicio }}" placeholder="Ej. Masaje Relajante" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Categoría</label>
                        <select name="categoria_id" class="form-control-custom" required>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}" {{ $servicio->categoria_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nombre_categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label-custom">Precio ($)</label>
                            <input type="number" step="0.01" name="precio" class="form-control-custom" value="{{ $servicio->precio }}" placeholder="0.00" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Estado del Servicio</label>
                            <select name="activo" class="form-control-custom">
                                <option value="1" {{ $servicio->activo ? 'selected' : '' }}>Activo (Visible)</option>
                                <option value="0" {{ !$servicio->activo ? 'selected' : '' }}>Inactivo (Oculto)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label-custom">Imagen del Servicio</label>
                        <div class="d-flex align-items-center gap-4">
                            <div class="text-center">
                                @if($servicio->imagen && file_exists(public_path($servicio->imagen)))
                                    <div class="img-preview-container">
                                        <img src="{{ asset($servicio->imagen) }}" width="120" height="120" class="img-preview" alt="Vista previa">
                                    </div>
                                    <div style="font-size: 0.8rem; color: #888;">Actual</div>
                                @else
                                    <div class="img-preview-container" style="width: 120px; height: 120px; display: flex; align-items: center; justify-content: center; background: #f0f0f0; color: #aaa;">
                                        Sin foto
                                    </div>
                                @endif
                            </div>
                            
                            <div style="flex-grow: 1; padding-left: 20px;">
                                <label for="fotoInput" style="cursor: pointer; display: block; margin-bottom: 5px; color: #5c4b45; font-weight: bold;">Cambiar Imagen</label>
                                <input type="file" name="foto" id="fotoInput" class="form-control-custom" style="padding: 0.5rem;">
                                <small class="text-muted" style="font-family: 'Lato';">Formatos: JPG, PNG. Máx 2MB.</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pt-3" style="border-top: 1px solid #eee;">
                        <a href="{{ route('admin.servicios.reporte') }}" class="btn-custom-secondary">Cancelar</a>
                        <button type="submit" class="btn-custom-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection