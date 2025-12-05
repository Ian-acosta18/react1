@extends('layouts.app')

@section('content')
<div class="admin-form-wrapper">
    
    <div class="form-card fade-in-up">
        <div class="form-header">
            <h2 class="form-title">Editar Producto</h2>
            <p class="form-subtitle">Modificando: <strong>{{ $producto->nombre }}</strong></p>
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

        <form action="{{ route('admin.productos.actualizar') }}" method="POST" enctype="multipart/form-data" class="premium-form">
            @csrf
            {{-- ID Oculto --}}
            <input type="hidden" name="id" value="{{ $producto->id }}">
            
            <div class="form-group-premium">
                <label for="nombre">Nombre del Producto</label>
                <div class="input-with-icon">
                    <input type="text" name="nombre" class="input-premium" value="{{ old('nombre', $producto->nombre) }}" required>
                    <span class="icon-right">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </span>
                </div>
            </div>

            <div class="form-group-premium">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" rows="3" class="input-premium">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label>Precio ($)</label>
                    <div class="input-with-icon">
                        <input type="number" step="0.01" name="precio" class="input-premium" value="{{ old('precio', $producto->precio) }}" required>
                    </div>
                </div>
                <div class="form-col">
                    <label>Stock</label>
                    <div class="input-with-icon">
                        <input type="number" name="stock" class="input-premium" value="{{ old('stock', $producto->stock) }}">
                    </div>
                </div>
            </div>

            {{-- --- NUEVO CAMPO: ESTADO --- --}}
            <div class="form-group-premium mt-3">
                <label for="activo">Estado del Producto</label>
                <div class="input-with-icon">
                    <select name="activo" id="activo" class="input-premium">
                        <option value="1" {{ $producto->activo ? 'selected' : '' }}>🟢 Activo (Visible)</option>
                        <option value="0" {{ !$producto->activo ? 'selected' : '' }}>🔴 Inactivo (Oculto)</option>
                    </select>
                </div>
            </div>
            {{-- --------------------------- --}}

            <div class="form-group-premium mt-4">
                <label>Gestión de Imagen</label>
                <div class="image-edit-grid">
                    <div class="current-image-container">
                        <span class="mini-label">Imagen Actual:</span>
                        <div class="img-preview-box">
                            @if($producto->imagen != "" && file_exists(public_path($producto->imagen)))
                                <img src="{{ asset($producto->imagen) }}" alt="Actual">
                                <span class="badge-status success">✓ Activa</span>
                            @else
                                <img src="{{ asset('imagen/sinfoto.jpg') }}" alt="Sin imagen" style="opacity:0.6;">
                            @endif
                        </div>
                    </div>

                    <div class="new-image-container">
                        <span class="mini-label">Cambiar por (Opcional):</span>
                        <div class="file-upload-wrapper">
                            <input type="file" name="imagen" class="input-file-premium" accept="image/*">
                            <div class="file-fake-input">
                                <span class="file-icon">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                </span>
                                <span class="file-text">Seleccionar nueva imagen</span>
                            </div>
                        </div>
                        <small class="text-muted mt-2 d-block">Solo sube un archivo si deseas reemplazar la imagen actual.</small>
                    </div>
                </div>
            </div>

            <div class="form-actions mt-5">
                <a href="{{ route('admin.productos.reporte') }}" class="btn-ghost">Cancelar</a>
                <button type="submit" class="btn-submit-premium">Actualizar Producto</button>
            </div>
        </form>
    </div>
</div>
@endsection