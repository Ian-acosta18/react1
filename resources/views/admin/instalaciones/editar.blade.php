@extends('layouts.app')

@section('content')
<div class="admin-form-wrapper">
    
    <div class="form-card fade-in-up">
        <div class="form-header">
            <h2 class="form-title">Editar Instalación</h2>
            <p class="form-subtitle">Editando: <strong>{{ $instalacion->titulo }}</strong></p>
            <hr class="separator">
        </div>

        @if (count($errors) > 0)
        <div class="alert-premium error mb-4">
            <ul class="alert-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.instalaciones.actualizar') }}" method="POST" enctype="multipart/form-data" class="premium-form">
            @csrf
            <input type="hidden" name="id" value="{{ $instalacion->id }}">

            <div class="form-group-premium">
                <label>Título</label>
                <div class="input-with-icon">
                    <input type="text" name="titulo" class="input-premium" value="{{ $instalacion->titulo }}" required>
                    <span class="icon-right">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </span>
                </div>
            </div>

            <div class="form-group-premium">
                <label>Descripción</label>
                <textarea name="descripcion" class="input-premium" rows="3" required>{{ $instalacion->descripcion }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label>Orden</label>
                    <input type="number" name="orden" class="input-premium" value="{{ $instalacion->orden }}">
                </div>
                <div class="form-col">
                    <label>Estado</label>
                    <div class="select-wrapper">
                        <select name="activo" class="input-premium">
                            <option value="1" {{ $instalacion->activo ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ !$instalacion->activo ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        <span class="select-arrow">▼</span>
                    </div>
                </div>
            </div>

            <div class="form-group-premium mt-4">
                <label>Gestión de Imagen</label>
                <div class="image-edit-grid">
                    <div class="current-image-container">
                        <span class="mini-label">Imagen Actual:</span>
                        <div class="img-preview-box">
                            <img src="{{ asset($instalacion->imagen) }}" alt="Actual">
                            <span class="badge-status success">✓ Cargada</span>
                        </div>
                    </div>
                    <div class="new-image-container">
                        <span class="mini-label">Cambiar (Opcional):</span>
                        <div class="file-upload-wrapper">
                            <input type="file" name="foto" class="input-file-premium">
                            <div class="file-fake-input">
                                <span class="file-icon">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                </span>
                                <span class="file-text">Seleccionar archivo...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions mt-5">
                <a href="{{ route('admin.instalaciones.reporte') }}" class="btn-ghost">Cancelar</a>
                <button type="submit" class="btn-submit-premium">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection