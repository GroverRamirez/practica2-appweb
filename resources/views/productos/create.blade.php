@extends('layouts.app')

@section('title', 'Nuevo producto')
@section('subtitle', 'Registra un producto con su categoria, precio, stock e imagen opcional.')

@section('content')
    <div class="form-card p-4">
        <h2 class="h4 mb-3">Datos del producto</h2>
        <p class="text-secondary mb-4">Completa la informacion principal del inventario antes de guardar.</p>

        <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
            @include('productos._form')
        </form>
    </div>
@endsection
