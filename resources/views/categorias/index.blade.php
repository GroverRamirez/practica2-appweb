@extends('layouts.app')

@section('title', 'Categorias')
@section('subtitle', 'Crea, filtra y administra las categorias que organizan el inventario.')

@section('actions')
    <x-ui.action-button :href="route('categorias.reporte.excel', ['buscar' => $buscar ?: null])" variant="success">
        <i class="bi bi-file-earmark-excel"></i>
        Exportar Excel
    </x-ui.action-button>
    <x-ui.action-button :href="route('categorias.reporte.pdf')" variant="outline-dark">
        <i class="bi bi-file-earmark-pdf"></i>
        Exportar PDF
    </x-ui.action-button>
    <x-ui.action-button :href="route('categorias.create')" variant="primary">
        <i class="bi bi-plus-circle"></i>
        Nueva categoria
    </x-ui.action-button>
@endsection

@section('content')
    <div class="table-card p-4">
        <x-ui.search-bar :route="route('categorias.index')" :value="$buscar" placeholder="Buscar por nombre, descripcion o estado" />

        @if ($buscar)
            <div class="alert alert-info border-0 rounded-4">
                <i class="bi bi-funnel me-2"></i>Filtro aplicado: <strong>{{ $buscar }}</strong>
            </div>
        @endif

        @if ($categorias->isEmpty())
            <div class="empty-state">
                <i class="bi bi-tags fs-1 d-block mb-3"></i>
                No hay categorias registradas con los criterios actuales.
            </div>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Productos</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td class="fw-semibold">{{ $categoria->nombre }}</td>
                                <td class="text-secondary">{{ \Illuminate\Support\Str::limit($categoria->descripcion ?: 'Sin descripcion', 70) }}</td>
                                <td><x-ui.badge :value="$categoria->estado" /></td>
                                <td>{{ $categoria->productos_count }}</td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-outline-dark">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" class="d-inline js-confirm-delete" data-confirm-title="Eliminar categoria" data-confirm-text="La categoria y sus productos asociados se eliminaran del sistema.">
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

            <div class="mt-4">
                {{ $categorias->links() }}
            </div>
        @endif
    </div>
@endsection
