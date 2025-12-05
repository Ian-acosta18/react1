@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3">
                    <h2 style="font-family: 'Playfair Display', serif; color: #B98D7B; margin: 0; text-align: center;">
                        Editar Producto
                    </h2>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('admin.productos.actualizar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $producto->id }}">

                        {{-- NOMBRE --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #5c4b45;">Nombre del Producto:</label>
                            <input type="text" name="nombre" class="form-control form-control-lg" 
                                   value="{{ $producto->nombre }}" required>
                        </div>

                        {{-- DESCRIPCION --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #5c4b45;">Descripción:</label>
                            <textarea name="descripcion" class="form-control" rows="3" required>{{ $producto->descripcion }}</textarea>
                        </div>

                        {{-- PRECIO Y STOCK --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="color: #5c4b45;">Precio ($):</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" name="precio" class="form-control form-control-lg" 
                                           value="{{ $producto->precio }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="color: #5c4b45;">Stock:</label>
                                <input type="number" name="stock" class="form-control form-control-lg" 
                                       value="{{ $producto->stock }}" required>
                            </div>
                        </div>

                        {{-- IMAGEN --}}
                        <div class="mb-4 p-3 bg-light rounded border">
                            <label class="form-label fw-bold" style="color: #5c4b45;">Imagen Actual:</label>
                            <div class="d-flex align-items-center mb-3">
                                @if($producto->imagen != "" && file_exists(public_path($producto->imagen)))
                                    <img src="{{ asset($producto->imagen) }}" width="120" class="rounded shadow-sm me-3">
                                    <span class="text-success small"><i class="fas fa-check"></i> Imagen cargada</span>
                                @else
                                    <img src="{{ asset('imagen/sinfoto.jpg') }}" width="120" class="rounded shadow-sm me-3" style="opacity: 0.6;">
                                    <span class="text-muted small">Sin imagen asignada</span>
                                @endif
                            </div>

                            <label class="form-label text-muted small">¿Deseas cambiar la imagen? (Opcional)</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>

                        {{-- BOTONES --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('admin.productos.reporte') }}" class="btn btn-secondary px-4 me-2">Cancelar</a>
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