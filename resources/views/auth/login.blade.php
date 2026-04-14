<x-guest-layout>
    <div class="mb-4">
        <h1 class="h2 mb-2">Iniciar sesion</h1>
        <p class="text-secondary mb-0">Accede al panel de gestion con tus credenciales.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success rounded-4 border-0">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="row g-3">
        @csrf

        <div class="col-12">
            <label for="email" class="form-label">Correo electronico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <label for="password" class="form-label mb-0">Contraseña</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="small text-decoration-none">¿Olvidaste tu contraseña?</a>
                @endif
            </div>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label">Recordarme</label>
            </div>
        </div>

        <div class="col-12 d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-box-arrow-in-right me-2"></i>Ingresar
            </button>
            <a href="{{ route('register') }}" class="btn btn-outline-dark">Crear una cuenta</a>
        </div>
    </form>
</x-guest-layout>
