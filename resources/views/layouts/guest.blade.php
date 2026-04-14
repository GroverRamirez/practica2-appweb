<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AppWeb GestionProductos') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        {{-- Layout usado por login, registro y recuperacion de acceso. --}}
        <div class="auth-shell page-enter">
            <div class="auth-grid">
                <section class="auth-promo">
                    <div class="d-inline-flex align-items-center gap-2 rounded-pill bg-white bg-opacity-10 px-3 py-2 small text-uppercase">
                        <i class="bi bi-shield-check"></i>
                        Acceso protegido
                    </div>
                    <h1 class="display-6 fw-bold mt-4 mb-3">Gestiona inventario, categorias y reportes desde un panel claro y rapido.</h1>
                    <p class="mb-4 text-white-50">
                        La practica integra autenticacion, CRUD, reportes PDF, imagenes y metricas de inventario en una sola aplicacion Laravel.
                    </p>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="feature-item h-100 bg-white bg-opacity-10 border-0 text-white">
                                <div class="fw-semibold mb-2"><i class="bi bi-tags me-2"></i>Categorias</div>
                                <div class="text-white-50 small">Organiza el catalogo y controla el estado de cada modulo.</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-item h-100 bg-white bg-opacity-10 border-0 text-white">
                                <div class="fw-semibold mb-2"><i class="bi bi-file-earmark-pdf me-2"></i>Reportes</div>
                                <div class="text-white-50 small">Exporta resumenes listos para revision o entrega.</div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="auth-card p-4 p-lg-5">
                    {{-- Slot donde cada pantalla de autenticacion inserta su formulario. --}}
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <a href="{{ route('welcome') }}" class="brand-badge"><i class="bi bi-box-seam"></i></a>
                        <div>
                            <div class="text-uppercase small text-secondary fw-semibold">AppWeb GestionProductos</div>
                            <div class="text-muted small">Accede o crea tu cuenta para continuar.</div>
                        </div>
                    </div>

                    {{ $slot }}
                </section>
            </div>
        </div>
    </body>
</html>
