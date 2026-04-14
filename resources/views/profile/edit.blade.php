@extends('layouts.app')

@section('title', 'Perfil')
@section('subtitle', 'Actualiza tus datos de acceso, cambia tu contraseña o elimina la cuenta.')

@section('content')
    @if (session('status') === 'profile-updated')
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>Perfil actualizado correctamente.
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
            <i class="bi bi-shield-check me-2"></i>Contraseña actualizada correctamente.
        </div>
    @endif

    <div class="row g-4">
        <div class="col-xl-6">
            <div class="form-card p-4 h-100">
                <h2 class="h4 mb-3">Informacion de perfil</h2>
                <p class="text-secondary">Mantén actualizados tu nombre y correo electrónico.</p>

                <form method="POST" action="{{ route('profile.update') }}" class="row g-3">
                    @csrf
                    @method('PATCH')

                    <div class="col-12">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Correo electronico</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="form-card p-4 h-100">
                <h2 class="h4 mb-3">Cambiar contraseña</h2>
                <p class="text-secondary">Usa una contraseña segura para proteger tu cuenta.</p>

                <form method="POST" action="{{ route('password.update') }}" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label for="current_password" class="form-label">Contraseña actual</label>
                        <input type="password" id="current_password" name="current_password" class="form-control @if($errors->updatePassword->has('current_password')) is-invalid @endif" required>
                        @if ($errors->updatePassword->has('current_password'))
                            <div class="invalid-feedback">{{ $errors->updatePassword->first('current_password') }}</div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label for="password" class="form-label">Nueva contraseña</label>
                        <input type="password" id="password" name="password" class="form-control @if($errors->updatePassword->has('password')) is-invalid @endif" required>
                        @if ($errors->updatePassword->has('password'))
                            <div class="invalid-feedback">{{ $errors->updatePassword->first('password') }}</div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @if($errors->updatePassword->has('password_confirmation')) is-invalid @endif" required>
                        @if ($errors->updatePassword->has('password_confirmation'))
                            <div class="invalid-feedback">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                        @endif
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-dark">
                            <i class="bi bi-shield-lock me-2"></i>Actualizar contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12">
            <div class="form-card p-4 border border-danger-subtle">
                <h2 class="h4 mb-3 text-danger">Eliminar cuenta</h2>
                <p class="text-secondary">Esta operación cerrará tu sesión y eliminará tu usuario del sistema.</p>

                <form method="POST" action="{{ route('profile.destroy') }}" class="row g-3 js-confirm-delete" data-confirm-title="Eliminar cuenta" data-confirm-text="Tu cuenta será eliminada permanentemente.">
                    @csrf
                    @method('DELETE')

                    <div class="col-md-6">
                        <label for="delete_password" class="form-label">Confirma tu contraseña</label>
                        <input type="password" id="delete_password" name="password" class="form-control @if($errors->userDeletion->has('password')) is-invalid @endif" required>
                        @if ($errors->userDeletion->has('password'))
                            <div class="invalid-feedback">{{ $errors->userDeletion->first('password') }}</div>
                        @endif
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash3 me-2"></i>Eliminar cuenta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
