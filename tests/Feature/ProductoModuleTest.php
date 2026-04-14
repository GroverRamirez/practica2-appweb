<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_can_be_searched(): void
    {
        $user = User::factory()->create();
        $categoriaRedes = Categoria::factory()->create(['nombre' => 'Redes', 'estado' => 'activo']);
        $categoriaAudio = Categoria::factory()->create(['nombre' => 'Audio', 'estado' => 'activo']);

        Producto::factory()->create([
            'nombre' => 'Router WiFi 6',
            'categoria_id' => $categoriaRedes->id,
        ]);

        Producto::factory()->create([
            'nombre' => 'Auriculares Studio',
            'categoria_id' => $categoriaAudio->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/productos?buscar=Redes');

        $response
            ->assertOk()
            ->assertSeeText('Router WiFi 6')
            ->assertDontSeeText('Auriculares Studio');
    }

    public function test_products_are_paginated(): void
    {
        $user = User::factory()->create();
        $categoria = Categoria::factory()->create(['estado' => 'activo']);

        foreach (range(1, 8) as $index) {
            Producto::factory()->create([
                'nombre' => 'Producto '.$index,
                'categoria_id' => $categoria->id,
                'created_at' => now()->addSeconds($index),
                'updated_at' => now()->addSeconds($index),
            ]);
        }

        $response = $this
            ->actingAs($user)
            ->get('/productos?page=2');

        $response
            ->assertOk()
            ->assertSeeText('Producto 1')
            ->assertDontSeeText('Producto 8');
    }

    public function test_products_pdf_can_be_generated(): void
    {
        $user = User::factory()->create();
        $categoria = Categoria::factory()->create(['nombre' => 'Componentes', 'estado' => 'activo']);

        Producto::factory()->create([
            'nombre' => 'Memoria DDR5',
            'categoria_id' => $categoria->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('productos.reporte.pdf'));

        $response
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf');
    }

    public function test_products_excel_can_be_generated(): void
    {
        $user = User::factory()->create();
        $categoria = Categoria::factory()->create(['nombre' => 'Almacenamiento', 'estado' => 'activo']);

        Producto::factory()->create([
            'nombre' => 'SSD 1TB',
            'categoria_id' => $categoria->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('productos.reporte.excel'));

        $response
            ->assertOk()
            ->assertHeader('content-type', 'application/vnd.ms-excel; charset=UTF-8');
    }
}
