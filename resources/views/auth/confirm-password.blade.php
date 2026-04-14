<x-guest-layout>
    <div class="mb-4">
        <h1 class="h2 mb-2">Confirmar contraseña</h1>
        <p class="text-secondary mb-0">Esta es una zona protegida. Ingresa tu contraseña para continuar.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="row g-3">
        @csrf

        <div class="col-12">
            <label for="password" class="form-label">Contraseña</label>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 d-grid">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-shield-lock me-2"></i>Confirmar acceso
            </button>
        </div>
    </form>
</x-guest-layout>
