@props([
    'route',
    'value' => '',
    'placeholder' => 'Buscar...',
])

<form method="GET" action="{{ $route }}" class="search-bar mb-4">
    <div class="flex-grow-1">
        <label for="buscar" class="form-label visually-hidden">Buscar</label>
        <input
            id="buscar"
            name="buscar"
            type="search"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            class="form-control form-control-lg"
        >
    </div>

    <button type="submit" class="btn btn-dark btn-lg">
        <i class="bi bi-search me-2"></i>Buscar
    </button>

    @if ($value)
        <a href="{{ $route }}" class="btn btn-outline-secondary btn-lg">
            <i class="bi bi-x-circle me-2"></i>Limpiar
        </a>
    @endif
</form>
