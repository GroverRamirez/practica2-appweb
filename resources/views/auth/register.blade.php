<x-guest-layout>
    <div class="mb-4">
        <h1 class="h2 mb-2">Crear cuenta</h1>
        <p class="text-secondary mb-0">Registra un usuario para ingresar al panel privado.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="row g-3">
        @csrf

        <div class="col-12">
            <label for="name" class="form-label">Nombre completo</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="email" class="form-label">Correo electronico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="password" class="form-label">Contraseña</label>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required autocomplete="new-password">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-person-plus me-2"></i>Registrar usuario
            </button>
            <a href="{{ route('login') }}" class="btn btn-outline-dark">Ya tengo una cuenta</a>
        </div>
    </form>
</x-guest-layout>
