@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3">
                    <h2 style="font-family: 'Playfair Display', serif; color: #B98D7B; margin: 0; text-align: center;">
                        Editar Servicio
                    </h2>
                </div>
                
                <div class="card-body p-4">
                    {{-- Formulario apuntando a la ruta de actualizar --}}
                    <form action="{{ route('admin.servicios.actualizar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- ID Oculto (Indispensable para saber cuál actualizar) --}}
                        <input type="hidden" name="id" value="{{ $servicio->id }}">

                        {{-- 1. NOMBRE --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #5c4b45;">Nombre del Servicio:</label>
                            <input type="text" name="nombre_servicio" class="form-control form-control-lg" 
                                   value="{{ $servicio->nombre_servicio }}" required>
                        </div>

                        {{-- 2. CATEGORÍA (Dropdown) --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #5c4b45;">Categoría:</label>
                            <select name="categoria_id" class="form-select form-select-lg" required>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}" 
                                        {{-- Esto selecciona la categoría que ya tenía el servicio --}}
                                        {{ $servicio->categoria_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nombre_categoria }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- 3. PRECIO --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #5c4b45;">Precio ($):</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" name="precio" class="form-control form-control-lg" 
                                       value="{{ $servicio->precio }}" required>
                            </div>
                        </div>

                        {{-- 4. IMAGEN (Previsualización y Cambio) --}}
                        <div class="mb-4 p-3 bg-light rounded border">
                            <label class="form-label fw-bold" style="color: #5c4b45;">Imagen Actual:</label>
                            <div class="d-flex align-items-center mb-3">
                                {{-- Lógica para mostrar la foto actual o sinfoto --}}
                                @if($servicio->imagen != "" && file_exists(public_path($servicio->imagen)))
                                    <img src="{{ asset($servicio->imagen) }}" width="120" class="rounded shadow-sm me-3">
                                    <span class="text-success small"><i class="fas fa-check"></i> Imagen cargada</span>
                                @else
                                    <img src="{{ asset('imagen/sinfoto.jpg') }}" width="120" class="rounded shadow-sm me-3" style="opacity: 0.6;">
                                    <span class="text-muted small">Sin imagen asignada (Se usa por defecto)</span>
                                @endif
                            </div>

                            <label class="form-label text-muted small">¿Deseas cambiar la imagen? (Opcional)</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>

                        {{-- BOTONES --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('admin.servicios.reporte') }}" class="btn btn-secondary px-4 me-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-4" style="background-color: #B98D7B; border: none;">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection