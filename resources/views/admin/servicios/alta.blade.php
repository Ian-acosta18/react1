@extends('layouts.app')

@section('content')

{{-- Estilos específicos para este formulario (puedes moverlos a tu CSS luego si prefieres) --}}
<style>
    .form-container {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        padding: 40px;
        border: 1px solid rgba(185, 141, 123, 0.2); /* Color principal muy sutil */
    }

    .titulo-admin {
        font-family: 'Playfair Display', serif;
        color: #5c4b45; /* Color texto oscuro */
        font-weight: 600;
        text-align: center;
        margin-bottom: 30px;
        letter-spacing: 1px;
    }

    .form-label-custom {
        font-family: 'Lato', sans-serif;
        font-weight: 600;
        color: #8a766f;
        margin-bottom: 8px;
        display: block;
    }

    .input-custom {
        border: 2px solid #f0f0f0;
        border-radius: 8px;
        padding: 12px 15px;
        font-family: 'Lato', sans-serif;
        transition: all 0.3s ease;
        background-color: #fafafa;
    }

    .input-custom:focus {
        border-color: #B98D7B; /* Tu color principal */
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(185, 141, 123, 0.1);
        outline: none;
    }

    .btn-guardar {
        background-color: #B98D7B;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 30px;
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        transition: transform 0.2s, background-color 0.3s;
        width: 100%;
        display: block;
    }

    .btn-guardar:hover {
        background-color: #a07665;
        transform: translateY(-2px);
        color: white;
    }

    .btn-cancelar {
        background-color: transparent;
        color: #999;
        border: 1px solid #ddd;
        padding: 12px 30px;
        border-radius: 30px;
        font-family: 'Lato', sans-serif;
        text-align: center;
        transition: all 0.3s;
        text-decoration: none;
        display: block;
        margin-top: 15px;
    }

    .btn-cancelar:hover {
        background-color: #f8f8f8;
        color: #666;
        border-color: #ccc;
    }

    /* Mejora visual para el input de archivo */
    .file-input-wrapper {
        position: relative;
        padding: 20px;
        border: 2px dashed #ddd;
        border-radius: 8px;
        text-align: center;
        background: #fafafa;
        transition: border-color 0.3s;
    }
    .file-input-wrapper:hover {
        border-color: #B98D7B;
    }
</style>

<div class="container" style="margin-top: 50px; margin-bottom: 50px; max-width: 700px;">
    
    <div class="form-container">
        <h2 class="titulo-admin">Nuevo Servicio</h2>
        <p class="text-center text-muted mb-4" style="font-family: 'Lato', sans-serif;">Ingresa los detalles para añadir un nuevo tratamiento al catálogo.</p>

        @if (count($errors) > 0)
            <div class="alert alert-danger" style="border-radius: 8px; border-left: 5px solid #dc3545;">
                <strong style="font-family: 'Playfair Display', serif;">¡Atención!</strong>
                <ul class="mb-0 mt-1" style="font-family: 'Lato', sans-serif; font-size: 0.9rem;">
                    @foreach ($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.servicios.guardar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- Nombre --}}
            <div class="mb-4">
                <label class="form-label-custom">Nombre del Servicio</label>
                <input type="text" name="nombre_servicio" class="form-control input-custom" placeholder="Ej: Masaje Relajante" value="{{ old('nombre_servicio') }}" required>
            </div>

            {{-- Categoría --}}
            <div class="mb-4">
                <label class="form-label-custom">Categoría</label>
                <select name="categoria_id" class="form-control input-custom" required>
                    <option value="">Seleccione una categoría...</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nombre_categoria }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-4">
                {{-- Precio --}}
                <div class="col-md-6">
                    <label class="form-label-custom">Precio ($)</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background: #f0f0f0; border:none; border-radius: 8px 0 0 8px;">$</span>
                        <input type="number" step="0.01" name="precio" class="form-control input-custom" style="border-radius: 0 8px 8px 0;" placeholder="0.00" value="{{ old('precio') }}" required>
                    </div>
                </div>
                
                {{-- Estado --}}
                <div class="col-md-6">
                    <label class="form-label-custom">Estado de Disponibilidad</label>
                    <select name="activo" class="form-control input-custom">
                        <option value="1" selected>Activo (Visible)</option>
                        <option value="0">Inactivo (Oculto)</option>
                    </select>
                </div>
            </div>

            {{-- Foto --}}
            <div class="mb-5">
                <label class="form-label-custom">Fotografía del Servicio</label>
                <div class="file-input-wrapper">
                    <input type="file" name="foto" class="form-control" style="opacity: 0.9;" required>
                    <small class="text-muted d-block mt-2">Formatos recomendados: JPG, PNG. Máx 2MB.</small>
                </div>
            </div>

            {{-- Botones de Acción --}}
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-guardar shadow-sm">
                    Guardar Servicio
                </button>
                <a href="{{ route('admin.servicios.reporte') }}" class="btn btn-cancelar">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection