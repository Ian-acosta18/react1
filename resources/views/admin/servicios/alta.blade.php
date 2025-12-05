@extends('layouts.app')

@section('content')
<div class="admin-form-wrapper">
    
    <div class="form-card fade-in-up">
        <div class="form-header">
            <h2 class="form-title">Nuevo Servicio</h2>
            <p class="form-subtitle">Complete los detalles para añadir al catálogo</p>
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

        <form action="{{ route('admin.servicios.guardar') }}" method="POST" enctype="multipart/form-data" class="premium-form">
            @csrf
            
            <div class="form-group-premium">
                <label for="nombre_servicio">Nombre del Servicio</label>
                <div class="input-with-icon">
                    <input type="text" id="nombre_servicio" name="nombre_servicio" class="input-premium" value="{{ old('nombre_servicio') }}" placeholder="Ej. Masaje de Piedras Calientes" required>
                    <span class="icon-right">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label for="categoria_id">Categoría</label>
                    <div class="select-wrapper">
                        <select id="categoria_id" name="categoria_id" class="input-premium" required>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nombre_categoria }}</option>
                            @endforeach
                        </select>
                        <span class="select-arrow">▼</span>
                    </div>
                </div>

                <div class="form-col">
                    <label for="precio">Precio ($)</label>
                    <div class="input-with-icon">
                        <input type="number" step="0.01" id="precio" name="precio" class="input-premium" value="{{ old('precio') }}" placeholder="0.00" required>
                    </div>
                </div>
            </div>

            <div class="form-group-premium">
                <label for="foto">Imagen Destacada</label>
                <div class="file-upload-wrapper">
                    <input type="file" id="foto" name="foto" class="input-file-premium">
                    <div class="file-fake-input">
                        <span class="file-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </span>
                        <span class="file-text">Click para subir imagen (JPG, PNG)</span>
                    </div>
                </div>
            </div>

            <div class="form-actions mt-5">
                <a href="{{ route('admin.servicios.reporte') }}" class="btn-ghost">
                    Cancelar
                </a>
                <button type="submit" class="btn-submit-premium">
                    Guardar Servicio
                </button>
            </div>
        </form>
    </div>
</div>
@endsection