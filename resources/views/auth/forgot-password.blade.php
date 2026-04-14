<x-guest-layout>
    <div class="mb-4">
        <h1 class="h2 mb-2">Recuperar contraseña</h1>
        <p class="text-secondary mb-0">Ingresa tu correo y te enviaremos un enlace para restablecerla.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success rounded-4 border-0">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="row g-3">
        @csrf

        <div class="col-12">
            <label for="email" class="form-label">Correo electronico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-envelope-arrow-up me-2"></i>Enviar enlace de recuperacion
            </button>
            <a href="{{ route('login') }}" class="btn btn-outline-dark">Volver al inicio de sesion</a>
        </div>
    </form>
</x-guest-layout>
