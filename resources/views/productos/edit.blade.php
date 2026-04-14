@extends('layouts.app')

@section('title', 'Editar producto')
@section('subtitle', 'Actualiza los datos, imagen y stock del producto seleccionado.')

@section('content')
    <div class="form-card p-4">
        {{-- Vista de edicion que reutiliza el mismo parcial del formulario. --}}
        <h2 class="h4 mb-3">Editar {{ $producto->nombre }}</h2>
        <p class="text-secondary mb-4">Si reemplazas la imagen, el sistema eliminara automaticamente la anterior.</p>

        <form method="POST" action="{{ route('productos.update', $producto) }}" enctype="multipart/form-data">
            @include('productos._form', ['producto' => $producto])
        </form>
    </div>
@endsection
