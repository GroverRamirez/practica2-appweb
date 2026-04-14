@extends('layouts.app')

@section('title', 'Nueva categoria')
@section('subtitle', 'Registra una nueva categoria para ordenar el catalogo de productos.')

@section('content')
    <div class="form-card p-4">
        <h2 class="h4 mb-3">Datos de la categoria</h2>
        <p class="text-secondary mb-4">Completa la informacion basica antes de guardar el registro.</p>

        <form method="POST" action="{{ route('categorias.store') }}">
            @include('categorias._form')
        </form>
    </div>
@endsection
