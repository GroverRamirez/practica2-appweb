<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'AppWeb GestionProductos') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        {{-- Landing publica del proyecto para presentar alcance y accesos principales. --}}
        <main class="landing-hero page-enter">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-5">
                    <a href="{{ route('welcome') }}" class="brand-lockup">
                        <span class="brand-badge"><i class="bi bi-box-seam"></i></span>
                        <span>
                            <span class="brand-label d-block text-dark">AppWeb GestionProductos</span>
                            <span class="brand-copy d-block">Proyecto Laravel desde cero</span>
                        </span>
                    </a>

                    <div class="d-flex gap-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-dark">
                                <i class="bi bi-speedometer2 me-2"></i>Ir al dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-dark">Ingresar</a>
                            <a href="{{ route('register') }}" class="btn btn-primary">Crear cuenta</a>
                        @endauth
                    </div>
                </div>

                <section class="landing-grid align-items-center mb-5">
                    <div>
                        <span class="badge text-bg-warning rounded-pill px-3 py-2 mb-3">Laravel + Bootstrap 5 + PDF + CRUD</span>
                        <h1 class="display-4 fw-bold mb-3">Gestiona categorias y productos con una interfaz clara, rapida y lista para crecer.</h1>
                        <p class="lead text-secondary mb-4">
                            La practica integra autenticacion, panel privado, metricas, busqueda, paginacion, imagenes, reportes PDF y pruebas feature sobre un flujo academico completo.
                        </p>

                        <div class="d-flex flex-wrap gap-3">
                            @auth
                                <a href="{{ route('dashboard') }}" class="btn btn-dark btn-lg">
                                    <i class="bi bi-arrow-right-circle me-2"></i>Continuar en el panel
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-person-plus me-2"></i>Comenzar ahora
                                </a>
                                <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Ya tengo cuenta
                                </a>
                            @endauth
                        </div>
                    </div>

                    <div class="landing-panel">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="feature-item h-100">
                                    <div class="fw-semibold mb-2"><i class="bi bi-tags me-2 text-success"></i>CRUD categorias</div>
                                    <div class="text-secondary small">Altas, bajas, edicion y filtros con estados activos e inactivos.</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="feature-item h-100">
                                    <div class="fw-semibold mb-2"><i class="bi bi-boxes me-2 text-primary"></i>CRUD productos</div>
                                    <div class="text-secondary small">Relacion con categorias, imagenes, stock y valuacion del inventario.</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="feature-item h-100">
                                    <div class="fw-semibold mb-2"><i class="bi bi-search me-2 text-info"></i>Busquedas utiles</div>
                                    <div class="text-secondary small">Filtros por nombre, descripcion, categoria y estado con paginacion persistente.</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="feature-item h-100">
                                    <div class="fw-semibold mb-2"><i class="bi bi-file-earmark-pdf me-2 text-danger"></i>Reportes PDF</div>
                                    <div class="text-secondary small">Exportacion lista para entrega en vertical y horizontal segun el modulo.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Tarjetas que resumen las fases academicas del proyecto. --}}
                <section class="row g-4">
                    <div class="col-lg-4">
                        <div class="landing-panel h-100">
                            <div class="small text-uppercase text-secondary fw-semibold mb-2">Fase funcional</div>
                            <h2 class="h3 mb-3">Inventario y control</h2>
                            <p class="text-secondary mb-0">Dashboard con metricas, productos con stock bajo y ultimos registros para seguimiento rapido.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="landing-panel h-100">
                            <div class="small text-uppercase text-secondary fw-semibold mb-2">Fase visual</div>
                            <h2 class="h3 mb-3">Bootstrap con Sass</h2>
                            <p class="text-secondary mb-0">Sidebar fijo, panel responsivo, estilos tematicos y confirmaciones con SweetAlert2.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="landing-panel h-100">
                            <div class="small text-uppercase text-secondary fw-semibold mb-2">Fase de validacion</div>
                            <h2 class="h3 mb-3">Seeders y pruebas</h2>
                            <p class="text-secondary mb-0">Dataset demo consistente, localizacion en espanol y pruebas feature del flujo principal.</p>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </body>
</html>
