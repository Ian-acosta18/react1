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
                    <label for="stock_selector">Stock</label>
                    <div class="input-with-icon">
                        {{-- Mantenemos tu lógica de stock --}}
                        <select id="stock_selector" class="input-premium" style="margin-bottom: 10px;">
                            <option value="">Selecciona cantidad</option>
                            @if(isset($stock_opciones))
                                @foreach($stock_opciones as $opcion)
                                    <option value="{{ $opcion->cantidad }}">{{ $opcion->cantidad }}</option>
                                @endforeach
                            @endif
                            <option value="otro">Otro (Manual)</option>
                        </select>

                        <input type="number" id="stock" name="stock" class="input-premium" value="{{ old('stock') }}" placeholder="Cantidad manual" style="display: none;">
                    </div>
                </div>
            </div>

            {{-- --- NUEVO CAMPO: ESTADO --- --}}
            <div class="form-group-premium mt-3">
                <label for="activo">Estado del Producto</label>
                <div class="input-with-icon">
                    <select name="activo" id="activo" class="input-premium">
                        <option value="1" selected>🟢 Activo (Visible al público)</option>
                        <option value="0">🔴 Inactivo (Oculto)</option>
                    </select>
                </div>
            </div>
            {{-- --------------------------- --}}

            <div class="form-group-premium mt-3">
                <label for="imagen">Imagen del Producto</label>
                <div class="upload-container-clean">
                    <div class="upload-icon">
                        <svg width="30" height="30" fill="none" stroke="#B98D7B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="upload-input-group">
                        <p class="upload-instruction">Selecciona un archivo de tu equipo:</p>
                        <input type="file" id="imagen" name="imagen" class="form-control" style="border: 1px solid #e0e0e0; padding: 0.5rem; border-radius: 8px;">
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