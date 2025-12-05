@extends('layouts.app')

@section('content')
<div class="admin-form-wrapper">
    
    <div class="form-card fade-in-up">
        <div class="form-header">
            <h2 class="form-title">Nueva Instalación</h2>
            <p class="form-subtitle">Agrega áreas del spa para mostrar en la web</p>
            <hr class="separator">
        </div>

        @if (count($errors) > 0)
        <div class="alert-premium error mb-4">
            <div class="alert-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <ul class="alert-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.instalaciones.guardar') }}" method="POST" enctype="multipart/form-data" class="premium-form">
            @csrf
            
            <div class="form-group-premium">
                <label for="titulo">Título de la Instalación</label>
                <div class="input-with-icon">
                    <input type="text" name="titulo" class="input-premium" required placeholder="Ej. Cabina de Masajes">
                    <span class="icon-right">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </span>
                </div>
            </div>

            <div class="form-group-premium">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" class="input-premium" rows="3" required placeholder="Breve descripción del área..."></textarea>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label>Orden (Prioridad)</label>
                    <input type="number" name="orden" class="input-premium" value="0">
                </div>
                <div class="form-col">
                    <label>Estado</label>
                    <div class="select-wrapper">
                        <select name="activo" class="input-premium">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        <span class="select-arrow">▼</span>
                    </div>
                </div>
            </div>

            <div class="form-group-premium">
                <label>Fotografía</label>
                <div class="file-upload-wrapper">
                    <input type="file" name="foto" class="input-file-premium" required>
                    <div class="file-fake-input">
                        <span class="file-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </span>
                        <span class="file-text">Subir fotografía</span>
                    </div>
                </div>
            </div>

            <div class="form-actions mt-5">
                <a href="{{ route('admin.instalaciones.reporte') }}" class="btn-ghost">Cancelar</a>
                <button type="submit" class="btn-submit-premium">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection