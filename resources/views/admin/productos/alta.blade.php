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
                    <input type="text" id="nombre" name="nombre" class="input-premium" value="{{ old('nombre') }}" placeholder="Ej. Crema Hidratante" required>
                </div>
            </div>

            <div class="form-group-premium">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="input-premium">{{ old('descripcion') }}</textarea>
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
                    {{-- Input directo para stock --}}
                    <div class="input-with-icon">
                        <input type="number" name="stock" class="input-premium" value="{{ old('stock') }}">
                    </div>
                </div>
            </div>

            {{-- NUEVO CAMPO: ESTADO --}}
            <div class="form-group-premium mt-3">
                <label>Estado</label>
                <select name="activo" class="input-premium">
                    <option value="1" selected>🟢 Activo (Visible)</option>
                    <option value="0">🔴 Inactivo (Oculto)</option>
                </select>
            </div>

            <div class="form-group-premium mt-3">
                <label for="imagen">Imagen del Producto</label>
                <div class="upload-container-clean">
                    <div class="upload-input-group">
                        <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*">
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

{{-- Estilos y Scripts originales se mantienen --}}
<style>
    .upload-container-clean { display: flex; align-items: center; gap: 1.5rem; padding: 1.5rem; background-color: #fafafa; border: 1px dashed #dcdcdc; border-radius: 12px; transition: border-color 0.3s ease; }
    .upload-container-clean:hover { border-color: var(--color-principal, #B98D7B); background-color: #fff; }
    .upload-icon { background: #F9F3EC; padding: 10px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
    .upload-input-group { flex-grow: 1; }
    .upload-instruction { margin: 0 0 0.5rem 0; font-size: 0.9rem; color: #666; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stockSelector = document.getElementById('stock_selector');
        const stockInput = document.getElementById('stock');
        
        // Si no hay opciones, pasamos array vacío para evitar error de JS
        const predefinidos = @json(isset($stock_opciones) ? $stock_opciones->pluck('cantidad') : []);

        if (stockInput.value) {
            const valorGuardado = parseInt(stockInput.value);
            if (predefinidos.includes(valorGuardado)) {
                stockSelector.value = valorGuardado;
                stockInput.style.display = 'none';
            } else {
                stockSelector.value = 'otro';
                stockInput.style.display = 'block';
            }
        }

        stockSelector.addEventListener('change', function() {
            const seleccion = this.value;
            if (seleccion === 'otro') {
                stockInput.style.display = 'block';
                stockInput.value = ''; 
                stockInput.focus();
            } else {
                stockInput.style.display = 'none';
                stockInput.value = seleccion; 
            }
        });

        stockInput.addEventListener('input', function() {
            const valor = parseInt(this.value);
            if (!predefinidos.includes(valor)) {
                stockSelector.value = 'otro';
            }
        });
    });
</script>
@endsection