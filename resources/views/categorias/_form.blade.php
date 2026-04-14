@csrf

@isset($categoria)
    @method('PUT')
@endisset

<div class="row g-4">
    <div class="col-md-8">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $categoria->nombre ?? '') }}" class="form-control @error('nombre') is-invalid @enderror" maxlength="100" required>
        @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="estado" class="form-label">Estado</label>
        @isset($categoria)
            <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                <option value="activo" @selected(old('estado', $categoria->estado) === 'activo')>Activo</option>
                <option value="inactivo" @selected(old('estado', $categoria->estado) === 'inactivo')>Inactivo</option>
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        @else
            <input type="text" value="Activo" class="form-control" disabled>
            <div class="form-hint mt-2">Las nuevas categorias se crean con estado activo.</div>
        @endisset
    </div>

    <div class="col-12">
        <label for="descripcion" class="form-label">Descripcion</label>
        <textarea id="descripcion" name="descripcion" rows="5" class="form-control @error('descripcion') is-invalid @enderror" required>{{ old('descripcion', $categoria->descripcion ?? '') }}</textarea>
        @error('descripcion')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-2"></i>{{ isset($categoria) ? 'Actualizar categoria' : 'Guardar categoria' }}
        </button>
        <a href="{{ route('categorias.index') }}" class="btn btn-outline-dark">Cancelar</a>
    </div>
</div>
