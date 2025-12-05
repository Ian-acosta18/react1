@extends('layouts.app')

@section('content')
<div class="admin-form-wrapper">
    
    <div class="form-card fade-in-up">
        <div class="form-header">
            <h2 class="form-title">Nuevo Producto</h2>
            <p class="form-subtitle">Agrega un nuevo artículo a tu boutique</p>
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

        <form action="{{ route('admin.productos.guardar') }}" method="POST" enctype="multipart/form-data" class="premium-form">
            @csrf
            
            <div class="form-group-premium">
                <label for="nombre">Nombre del Producto</label>
                <div class="input-with-icon">
                    <input type="text" id="nombre" name="nombre" class="input-premium" value="{{ old('nombre') }}" placeholder="Ej. Crema Hidratante Facial" required>
                    <span class="icon-right">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </span>
                </div>
            </div>

            <div class="form-group-premium">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="input-premium" placeholder="Detalles del producto...">{{ old('descripcion') }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label for="precio">Precio ($)</label>
                    <div class="input-with-icon">
                        <input type="number" step="0.01" id="precio" name="precio" class="input-premium" value="{{ old('precio') }}" placeholder="0.00" required>
                    </div>
                </div>

                <div class="form-col">
                    <label for="stock">Stock (Cantidad)</label>
                    <div class="input-with-icon">
                        <input type="number" id="stock" name="stock" class="input-premium" value="{{ old('stock') }}" placeholder="0">
                    </div>
                </div>
            </div>

            <div class="form-group-premium">
                <label for="foto">Imagen del Producto</label>
                <div class="file-upload-wrapper">
                    <input type="file" id="foto" name="foto" class="input-file-premium">
                    <div class="file-fake-input">
                        <span class="file-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </span>
                        <span class="file-text">Seleccionar imagen (JPG, PNG)</span>
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