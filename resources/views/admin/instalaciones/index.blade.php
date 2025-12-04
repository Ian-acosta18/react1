@extends('layouts.app')

@section('content')
<div style="padding: 2rem; max-width: 1200px; margin: 0 auto;">
    <div class="admin-header">
        <h2 style="font-family: var(--fuente-titulos); color: var(--color-principal);">Administrar Instalaciones</h2>
        <a href="{{ route('instalaciones.create') }}" class="btn-nuevo">Nueva Instalación</a>
    </div>

    <div class="instalaciones-grid"> @foreach($instalaciones as $inst)
        <div class="instalacion-card" style="position: relative;">
            <div class="imagen-container" style="height: 200px;">
                <img src="{{ asset($inst->imagen) }}">
            </div>
            <div class="info">
                <h3>{{ $inst->titulo }}</h3>
                <div style="margin-top: 1rem;">
                    <a href="{{ route('instalaciones.edit', $inst->id) }}" class="btn-accion btn-editar">Editar</a>
                    <form action="{{ route('instalaciones.destroy', $inst->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn-accion btn-borrar">Borrar</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection