@extends('layouts.app')

@section('content')
<div class="admin-form-wrapper">
    
    <div class="form-card fade-in-up">
        <div class="form-header">
            <h2 class="form-title">Editar Servicio</h2>
            <p class="form-subtitle">Modificando: <strong>{{ $servicio->nombre_servicio }}</strong></p>
            <hr class="separator">
        </div>

        @if (count($errors) > 0)
        <div class="alert-premium error mb-4">
            <div class="alert-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <ul class="alert-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.servicios.actualizar') }}" method="POST" enctype="multipart/form-data" class="premium-form">
            @csrf
            {{-- ID Oculto (Indispensable) --}}
            <input type="hidden" name="id" value="{{ $servicio->id }}">

            <div class="form-group-premium">
                <label for="nombre_servicio">Nombre del Servicio</label>
                <div class="input-with-icon">
                    <input type="text" id="nombre_servicio" name="nombre_servicio" class="input-premium" 
                           value="{{ $servicio->nombre_servicio }}" required minlength="4" maxlength="60">
                    <span class="icon-right">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label for="categoria_id">Categoría</label>
                    <div class="select-wrapper">
                        <select id="categoria_id" name="categoria_id" class="input-premium" required>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}" 
                                    {{ $servicio->categoria_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nombre_categoria }}
                                </option>
                            @endforeach
                        </select>
                        <span class="select-arrow">▼</span>
                    </div>
                </div>

                <div class="form-col">
                    <label for="precio">Precio ($)</label>
                    <div class="input-with-icon">
                        <input type="number" step="0.01" id="precio" name="precio" class="input-premium" 
                               value="{{ $servicio->precio }}" required min="0" max="10000">
                    </div>
                </div>
            </div>

            <div class="form-group-premium mt-4">
                <label>Gestión de Imagen</label>
                
                <div class="image-edit-grid">
                    <div class="current-image-container">
                        <span class="mini-label">Imagen Actual:</span>
                        @if($servicio->imagen != "" && file_exists(public_path($servicio->imagen)))
                            <div class="img-preview-box">
                                <img src="{{ asset($servicio->imagen) }}" alt="Imagen Actual">
                                <span class="badge-status success">✓ Activa</span>
                            </div>
                        @else
                            <div class="img-preview-box">
                                <img src="{{ asset('imagen/sinfoto.jpg') }}" alt="Sin imagen" style="opacity: 0.6;">
                                <span class="badge-status warning">Por defecto</span>
                            </div>
                        @endif
                    </div>

                    <div class="new-image-container">
                        <span class="mini-label">Cambiar por (Opcional):</span>
                        <div class="file-upload-wrapper">
                            <input type="file" name="foto" class="input-file-premium" accept="image/*">
                            <div class="file-fake-input">
                                <span class="file-icon">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                </span>
                                <span class="file-text">Seleccionar nuevo archivo...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions mt-5">
                <a href="{{ route('admin.servicios.reporte') }}" class="btn-ghost">
                    Cancelar
                </a>
                <button type="submit" class="btn-submit-premium">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection