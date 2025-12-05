@extends('layouts.app')

@section('content')
<div class="admin-form-wrapper">
    <div class="form-card fade-in-up">
        <div class="form-header">
            <h2 class="form-title">Editar Producto</h2>
            <hr class="separator">
        </div>

        @if (count($errors) > 0)
        <div class="alert-premium error mb-4">
            <ul class="alert-list">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
        @endif

        {{-- Apunta a 'admin.productos.actualizar' --}}
        <form action="{{ route('admin.productos.actualizar') }}" method="POST" enctype="multipart/form-data" class="premium-form">
            @csrf
            <input type="hidden" name="id" value="{{ $producto->id }}">

            <div class="form-group-premium">
                <label>Nombre del Producto</label>
                <div class="input-with-icon">
                    <input type="text" name="nombre" class="input-premium" value="{{ old('nombre', $producto->nombre) }}" required>
                </div>
            </div>

            <div class="form-group-premium">
                <label>Descripción</label>
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

            {{-- CAMPO DE ESTADO --}}
            <div class="form-group-premium mt-3">
                <label>Estado</label>
                <div class="input-with-icon">
                    <select name="activo" class="input-premium">
                        <option value="1" {{ $producto->activo ? 'selected' : '' }}>🟢 Activo (Visible)</option>
                        <option value="0" {{ !$producto->activo ? 'selected' : '' }}>🔴 Inactivo (Oculto)</option>
                    </select>
                </div>
            </div>

            <div class="form-group-premium mt-4">
                <label>Imagen Actual</label>
                <div class="current-image-container mb-3">
                    @if($producto->imagen != "" && file_exists(public_path($producto->imagen)))
                        <img src="{{ asset($producto->imagen) }}" alt="Actual" style="width: 100px; border-radius: 8px;">
                    @else
                        <p class="text-muted">Sin imagen</p>
                    @endif
                </div>

                <label>Cambiar Imagen (Opcional)</label>
                <div class="upload-container-clean">
                    <input type="file" name="imagen" class="form-control" accept="image/*">
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