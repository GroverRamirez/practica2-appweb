@extends('layouts.app')

@section('title', 'Productos')
@section('subtitle', 'Administra el inventario, las imagenes y el stock de cada producto.')

@section('actions')
    <x-ui.action-button :href="route('productos.reporte.excel', ['buscar' => $buscar ?: null])" variant="success">
        <i class="bi bi-file-earmark-excel"></i>
        Exportar Excel
    </x-ui.action-button>
    <x-ui.action-button :href="route('productos.reporte.pdf')" variant="outline-dark">
        <i class="bi bi-file-earmark-pdf"></i>
        Exportar PDF
    </x-ui.action-button>
    <x-ui.action-button :href="route('productos.create')" variant="primary">
        <i class="bi bi-plus-circle"></i>
        Nuevo producto
    </x-ui.action-button>
@endsection

@section('content')
    <div class="table-card p-4">
        {{-- El filtro permite buscar por nombre, descripcion o categoria relacionada. --}}
        <x-ui.search-bar :route="route('productos.index')" :value="$buscar" placeholder="Buscar por nombre, descripcion o categoria" />

        @if ($buscar)
            <div class="alert alert-info border-0 rounded-4">
                <i class="bi bi-funnel me-2"></i>Filtro aplicado: <strong>{{ $buscar }}</strong>
            </div>
        @endif

        {{-- Estado vacio del inventario cuando la consulta no devuelve elementos. --}}
        @if ($productos->isEmpty())
            <div class="empty-state">
                <i class="bi bi-box-seam fs-1 d-block mb-3"></i>
                No hay productos registrados con los criterios actuales.
            </div>
        @else
            {{-- Tabla principal del inventario con imagen, categoria y acciones. --}}
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="thumb-preview">
                                        <div>
                                            <div class="fw-semibold">{{ $producto->nombre }}</div>
                                            <div class="text-secondary small">{{ \Illuminate\Support\Str::limit($producto->descripcion ?: 'Sin descripcion', 55) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $producto->categoria?->nombre ?? 'Sin categoria' }}</td>
                                <td>${{ number_format((float) $producto->precio, 2) }}</td>
                                <td>
                                    {{-- Cuando el stock es bajo se resalta visualmente. --}}
                                    @if ($producto->stock <= 5)
                                        <x-ui.badge :value="'Bajo'" variant="warning" />
                                    @else
                                        <span class="text-secondary">{{ $producto->stock }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-outline-dark">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- DELETE se envia por formulario para respetar REST y activar confirmacion. --}}
                                        <form method="POST" action="{{ route('productos.destroy', $producto) }}" class="d-inline js-confirm-delete" data-confirm-title="Eliminar producto" data-confirm-text="La imagen asociada tambien se eliminara del disco publico.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- El paginador mantiene el filtro gracias a withQueryString del controlador. --}}
            <div class="mt-4">
                {{ $productos->links() }}
            </div>
        @endif
    </div>
@endsection
