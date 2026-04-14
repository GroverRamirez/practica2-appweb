<x-guest-layout>
    <div class="mb-4">
        <h1 class="h2 mb-2">Restablecer contraseña</h1>
        <p class="text-secondary mb-0">Define una nueva contraseña para volver a ingresar al sistema.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="row g-3">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="col-12">
            <label for="email" class="form-label">Correo electronico</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" class="form-control @error('email') is-invalid @enderror" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="password" class="form-label">Nueva contraseña</label>
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

        <div class="col-12 d-grid">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-shield-lock me-2"></i>Restablecer contraseña
            </button>
        </div>
    </form>
</x-guest-layout>
