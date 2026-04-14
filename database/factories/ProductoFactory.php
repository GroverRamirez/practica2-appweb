<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Producto>
 */
class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->words(3, true),
            'descripcion' => fake()->sentence(14),
            'precio' => fake()->randomFloat(2, 20, 4500),
            'stock' => fake()->numberBetween(0, 35),
            'categoria_id' => Categoria::factory(),
            'imagen' => null,
        ];
    }
}
