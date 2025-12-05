@extends('layouts.app')

@section('content')
<div class="admin-form-wrapper">
    <div class="form-card fade-in-up">
        <div class="form-header">
            <h2 class="form-title">Nuevo Producto</h2>
            <hr class="separator">
        </div>

        @if (count($errors) > 0)
        <div class="alert-premium error mb-4">
            <ul class="alert-list">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
        @endif

        {{-- Apunta a 'admin.productos.guardar' --}}
        <form action="{{ route('admin.productos.guardar') }}" method="POST" enctype="multipart/form-data" class="premium-form">
            @csrf
            
            <div class="form-group-premium">
                <label>Nombre del Producto</label>
                <div class="input-with-icon">
                    <input type="text" name="nombre" class="input-premium" value="{{ old('nombre') }}" required>
                </div>
            </div>

            <div class="form-group-premium">
                <label>Descripción</label>
                <textarea name="descripcion" rows="3" class="input-premium">{{ old('descripcion') }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label>Precio ($)</label>
                    <div class="input-with-icon">
                        <input type="number" step="0.01" name="precio" class="input-premium" value="{{ old('precio') }}" required>
                    </div>
                </div>
                <div class="form-col">
                    <label>Stock</label>
                    <div class="input-with-icon">
                        <input type="number" name="stock" class="input-premium" value="{{ old('stock') }}">
                    </div>
                </div>
            </div>

            {{-- CAMPO DE ESTADO --}}
            <div class="form-group-premium mt-3">
                <label>Estado</label>
                <div class="input-with-icon">
                    <select name="activo" class="input-premium">
                        <option value="1" selected>🟢 Activo (Visible)</option>
                        <option value="0">🔴 Inactivo (Oculto)</option>
                    </select>
                </div>
            </div>

            <div class="form-group-premium mt-3">
                <label>Imagen</label>
                <div class="upload-container-clean">
                    <div class="upload-input-group">
                        <input type="file" name="imagen" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="form-actions mt-5">
                <a href="{{ route('admin.productos.reporte') }}" class="btn-ghost">Cancelar</a>
                <button type="submit" class="btn-submit-premium">Guardar Producto</button>
            </div>
        </form>
    </div>
</div>
@endsection
