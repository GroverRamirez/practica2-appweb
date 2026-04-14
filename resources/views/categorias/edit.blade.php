@extends('layouts.app')

@section('title', 'Editar categoria')
@section('subtitle', 'Actualiza el nombre, descripcion y estado de la categoria seleccionada.')

@section('content')
    <div class="form-card p-4">
        {{-- Reutiliza el mismo parcial de formulario, pero enviando la categoria actual. --}}
        <h2 class="h4 mb-3">Editar {{ $categoria->nombre }}</h2>
        <p class="text-secondary mb-4">Modifica los datos necesarios y guarda los cambios.</p>

        <form method="POST" action="{{ route('categorias.update', $categoria) }}">
            @include('categorias._form', ['categoria' => $categoria])
        </form>
    </div>
@endsection
