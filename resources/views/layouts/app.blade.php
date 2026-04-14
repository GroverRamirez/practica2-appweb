<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'AppWeb GestionProductos'))</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="app-shell page-enter">
            <aside class="app-sidebar offcanvas-lg offcanvas-start border-0" tabindex="-1" id="appSidebar" aria-labelledby="appSidebarLabel">
                <div class="offcanvas-header">
                    <a href="{{ route('dashboard') }}" class="brand-lockup">
                        <span class="brand-badge"><i class="bi bi-box-seam"></i></span>
                        <span>
                            <span class="brand-label d-block">AppWeb GestionProductos</span>
                            <span class="brand-copy d-block">Panel privado</span>
                        </span>
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-light d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#appSidebar" aria-label="Cerrar">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="offcanvas-body d-flex flex-column">
                    <div class="sidebar-nav nav flex-column">
                        <p class="sidebar-caption">Principal</p>
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a class="nav-link {{ request()->routeIs('categorias.*') ? 'active' : '' }}" href="{{ route('categorias.index') }}">
                            <i class="bi bi-tags"></i> Categorias
                        </a>
                        <a class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}" href="{{ route('productos.index') }}">
                            <i class="bi bi-boxes"></i> Productos
                        </a>

                        <p class="sidebar-caption">Cuenta</p>
                        <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person-circle"></i> Perfil
                        </a>
                        <a class="nav-link" href="{{ route('welcome') }}">
                            <i class="bi bi-house-door"></i> Sitio publico
                        </a>
                    </div>

                    <div class="sidebar-user">
                        <div class="small text-uppercase text-secondary-emphasis mb-2">Sesion actual</div>
                        <div class="fw-semibold">{{ auth()->user()->name }}</div>
                        <div class="text-secondary small">{{ auth()->user()->email }}</div>

                        <form method="POST" action="{{ route('logout') }}" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-outline-light w-100">
                                <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesion
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <div class="app-main">
                <div class="app-topbar">
                    <div class="glass-panel topbar-card p-3 p-lg-4">
                        <div class="d-flex flex-wrap align-items-start justify-content-between gap-3">
                            <div class="d-flex align-items-start gap-3">
                                <button class="btn btn-dark d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#appSidebar" aria-controls="appSidebar">
                                    <i class="bi bi-list"></i>
                                </button>
                                <div>
                                    <h1 class="page-title">@yield('title', 'Dashboard')</h1>
                                    <p class="page-subtitle">@yield('subtitle', 'Administra categorias, productos y tu inventario desde un solo panel.')</p>
                                </div>
                            </div>

                            @hasSection('actions')
                                <div class="d-flex flex-wrap gap-2">
                                    @yield('actions')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <main class="app-content">
                    @if (session('success'))
                        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                            <div class="fw-semibold mb-2">Revisa los datos enviados.</div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                    {{ $slot ?? '' }}
                </main>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
