<x-guest-layout>
    <div class="mb-4">
        <h1 class="h2 mb-2">Verificar correo</h1>
        <p class="text-secondary mb-0">
            Antes de continuar, revisa tu bandeja de entrada y confirma tu correo usando el enlace enviado.
        </p>
    </div>

    @if (session('status') === 'verification-link-sent')
        <div class="alert alert-success rounded-4 border-0">
            Se envio un nuevo enlace de verificacion al correo registrado.
        </div>
    @endif

    <div class="d-grid gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-lg w-100">
                <i class="bi bi-send-check me-2"></i>Reenviar verificacion
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-dark w-100">
                <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesion
            </button>
        </form>
    </div>
</x-guest-layout>
