@csrf

@isset($producto)
    @method('PUT')
@endisset

<div class="row g-4">
    <div class="col-md-8">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre ?? '') }}" class="form-control @error('nombre') is-invalid @enderror" maxlength="100" required>
        @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="categoria_id" class="form-label">Categoria</label>
        <select id="categoria_id" name="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror" required>
            <option value="">Selecciona una categoria</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" @selected((string) old('categoria_id', $producto->categoria_id ?? '') === (string) $categoria->id)>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
        @error('categoria_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" step="0.01" min="0" id="precio" name="precio" value="{{ old('precio', isset($producto) ? number_format((float) $producto->precio, 2, '.', '') : '') }}" class="form-control @error('precio') is-invalid @enderror" required>
        @error('precio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" min="0" id="stock" name="stock" value="{{ old('stock', $producto->stock ?? 0) }}" class="form-control @error('stock') is-invalid @enderror" required>
        @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="descripcion" class="form-label">Descripcion</label>
        <textarea id="descripcion" name="descripcion" rows="5" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
        @error('descripcion')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="imagen" class="form-label">Imagen</label>
        <input type="file" id="imagen" name="imagen" class="form-control @error('imagen') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
        @error('imagen')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-hint mt-2">Formatos permitidos: JPG, PNG y WEBP. Tamaño máximo: 2 MB.</div>
    </div>

    @isset($producto)
        <div class="col-12">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="thumb-preview">
                <div>
                    <div class="fw-semibold">Imagen actual</div>
                    <div class="text-secondary small">Si subes una nueva imagen, la anterior será reemplazada.</div>
                </div>
            </div>
        </div>
    @endisset

    <div class="col-12 d-flex flex-wrap gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-2"></i>{{ isset($producto) ? 'Actualizar producto' : 'Guardar producto' }}
        </button>
        <a href="{{ route('productos.index') }}" class="btn btn-outline-dark">Cancelar</a>
    </div>
</div>
