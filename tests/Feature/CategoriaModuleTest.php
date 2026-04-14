<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_can_be_searched(): void
    {
        $user = User::factory()->create();

        Categoria::factory()->create([
            'nombre' => 'Teclados',
            'descripcion' => 'Categoria orientada a perifericos de entrada.',
            'estado' => 'activo',
        ]);

        Categoria::factory()->create([
            'nombre' => 'Monitores',
            'descripcion' => 'Pantallas para estaciones de trabajo.',
            'estado' => 'activo',
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/categorias?buscar=Teclados');

        $response
            ->assertOk()
            ->assertSeeText('Teclados')
            ->assertDontSeeText('Monitores');
    }

    public function test_categories_are_paginated(): void
    {
        $user = User::factory()->create();

        foreach (range(1, 8) as $index) {
            Categoria::factory()->create([
                'nombre' => 'Categoria '.$index,
                'created_at' => now()->addSeconds($index),
                'updated_at' => now()->addSeconds($index),
            ]);
        }

        $response = $this
            ->actingAs($user)
            ->get('/categorias?page=2');

        $response
            ->assertOk()
            ->assertSeeText('Categoria 1')
            ->assertDontSeeText('Categoria 8');
    }

    public function test_categories_pdf_can_be_generated(): void
    {
        $user = User::factory()->create();

        Categoria::factory()->create([
            'nombre' => 'Procesadores',
            'descripcion' => 'CPU para ensambles de escritorio.',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('categorias.reporte.pdf'));

        $response
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf');
    }

    public function test_categories_excel_can_be_generated(): void
    {
        $user = User::factory()->create();

        Categoria::factory()->create([
            'nombre' => 'Tarjetas madre',
            'descripcion' => 'Componentes base para ensamblado.',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('categorias.reporte.excel'));

        $response
            ->assertOk()
            ->assertHeader('content-type', 'application/vnd.ms-excel; charset=UTF-8');
    }
}
