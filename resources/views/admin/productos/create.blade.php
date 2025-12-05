<form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="formulario">
        @csrf

        <div class="form-grupo">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grupo">
            <label>Descripción:</label>
            <textarea name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grupo" style="display: flex; gap: 1rem;">
            <div style="flex: 1;">
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" value="{{ old('precio') }}" required>
                @error('precio')
                    <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </div>
            <div style="flex: 1;">
                <label>Stock:</label>
                <input type="number" name="stock" value="{{ old('stock', 1) }}">
                @error('stock')
                    <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-grupo">
            <label>Imagen:</label>
            <input type="file" name="imagen" accept="image/*" required style="padding: 10px; background: white;">
            @error('imagen')
            <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Guardar Producto</button>
        <a href="{{ route('productos.index') }}" style="display:block; text-align:center; margin-top:1rem; color: #666;">Cancelar</a>
    </form>