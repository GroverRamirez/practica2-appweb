@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Resumen operativo del inventario y acceso rapido a los modulos principales.')

@section('actions')
    <x-ui.action-button :href="route('categorias.create')" variant="primary">
        <i class="bi bi-plus-circle"></i>
        Nueva categoria
    </x-ui.action-button>
    <x-ui.action-button :href="route('productos.create')" variant="warning">
        <i class="bi bi-box-seam"></i>
        Nuevo producto
    </x-ui.action-button>
@endsection

@section('content')
    <section class="dashboard-hero p-4 p-lg-5 mb-4">
        <span class="accent-pill mb-3">
            <i class="bi bi-activity"></i>
            Vista general
        </span>
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <h2 class="display-6 fw-bold mb-3">Controla categorias, stock y valuacion del inventario desde un mismo tablero.</h2>
                <p class="mb-0 text-white-50">
                    El panel centraliza indicadores clave y muestra los ultimos productos agregados para acelerar la administracion diaria.
                </p>
            </div>
            <div class="col-lg-5">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="rounded-4 bg-white bg-opacity-10 p-3">
                            <div class="small text-uppercase text-white-50">Categorias</div>
                            <div class="fs-2 fw-bold">{{ $totalCategorias }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="rounded-4 bg-white bg-opacity-10 p-3">
                            <div class="small text-uppercase text-white-50">Productos</div>
                            <div class="fs-2 fw-bold">{{ $totalProductos }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <article class="metric-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <div class="text-uppercase small text-secondary fw-semibold">Total categorias</div>
                        <div class="display-6 fw-bold mt-2">{{ $totalCategorias }}</div>
                    </div>
                    <span class="metric-icon"><i class="bi bi-tags"></i></span>
                </div>
                <p class="text-secondary mb-0">Categorias activas para agrupar y ordenar el catalogo del sistema.</p>
            </article>
        </div>

        <div class="col-md-6 col-xl-3">
            <article class="metric-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <div class="text-uppercase small text-secondary fw-semibold">Total productos</div>
                        <div class="display-6 fw-bold mt-2">{{ $totalProductos }}</div>
                    </div>
                    <span class="metric-icon"><i class="bi bi-boxes"></i></span>
                </div>
                <p class="text-secondary mb-0">Registros disponibles en inventario con categoria asociada.</p>
            </article>
        </div>

        <div class="col-md-6 col-xl-3">
            <article class="metric-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <div class="text-uppercase small text-secondary fw-semibold">Valuacion</div>
                        <div class="display-6 fw-bold mt-2">${{ number_format($valorInventario, 2) }}</div>
                    </div>
                    <span class="metric-icon"><i class="bi bi-cash-stack"></i></span>
                </div>
                <p class="text-secondary mb-0">Suma calculada con el precio y stock actual de cada producto.</p>
            </article>
        </div>

        <div class="col-md-6 col-xl-3">
            <article class="metric-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <div class="text-uppercase small text-secondary fw-semibold">Stock bajo</div>
                        <div class="display-6 fw-bold mt-2">{{ $productosBajoStock }}</div>
                    </div>
                    <span class="metric-icon"><i class="bi bi-exclamation-triangle"></i></span>
                </div>
                <p class="text-secondary mb-0">Productos con 5 unidades o menos para seguimiento rapido.</p>
            </article>
        </div>
    </section>

    <section class="row g-4">
        <div class="col-xl-8">
            <div class="table-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h3 class="h4 mb-1">Ultimos productos agregados</h3>
                        <p class="text-secondary mb-0">Se muestran los 5 registros mas recientes del inventario.</p>
                    </div>
                    <x-ui.action-button :href="route('productos.index')" variant="outline-dark">
                        <i class="bi bi-arrow-right"></i>
                        Ver catalogo
                    </x-ui.action-button>
                </div>

                @if ($ultimosProductos->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        Aun no existen productos registrados. Crea una categoria y luego agrega tu primer producto.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Registrado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ultimosProductos as $producto)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="thumb-preview">
                                                <div>
                                                    <div class="fw-semibold">{{ $producto->nombre }}</div>
                                                    <div class="text-secondary small">{{ \Illuminate\Support\Str::limit($producto->descripcion ?: 'Sin descripcion', 45) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $producto->categoria?->nombre ?? 'Sin categoria' }}</td>
                                        <td>${{ number_format((float) $producto->precio, 2) }}</td>
                                        <td>{{ $producto->stock }}</td>
                                        <td>{{ $producto->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-xl-4">
            <div class="table-card p-4 h-100">
                <h3 class="h4 mb-3">Accesos y recomendaciones</h3>
                <div class="vstack gap-3">
                    <div class="feature-item">
                        <div class="fw-semibold mb-2"><i class="bi bi-tags me-2 text-success"></i>Gestiona categorias</div>
                        <div class="text-secondary small">Crea, edita y filtra categorias para mantener el catalogo ordenado.</div>
                    </div>
                    <div class="feature-item">
                        <div class="fw-semibold mb-2"><i class="bi bi-images me-2 text-info"></i>Sube imagenes</div>
                        <div class="text-secondary small">Cada producto puede almacenar una imagen en el disco publico del proyecto.</div>
                    </div>
                    <div class="feature-item">
                        <div class="fw-semibold mb-2"><i class="bi bi-file-earmark-pdf me-2 text-danger"></i>Exporta PDF</div>
                        <div class="text-secondary small">Genera reportes listos para presentar sin depender del layout del panel.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
