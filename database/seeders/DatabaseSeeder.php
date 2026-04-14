<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'grover.ramirez@gmail.com',
        ], [
            'name' => 'Grover Ramirez',
            'password' => bcrypt('12345678'),
        ]);

        $dataset = [
            [
                'nombre' => 'Laptops',
                'descripcion' => 'Equipos portatiles para trabajo, estudio y desarrollo de software.',
                'estado' => 'activo',
                'productos' => [
                    ['nombre' => 'Lenovo ThinkPad E14', 'descripcion' => 'Laptop empresarial con Ryzen 7, 16 GB de RAM y SSD NVMe.', 'precio' => 1080.00, 'stock' => 8],
                    ['nombre' => 'ASUS Vivobook 15', 'descripcion' => 'Equipo equilibrado para ofimatica avanzada y clases virtuales.', 'precio' => 820.00, 'stock' => 5],
                ],
            ],
            [
                'nombre' => 'Perifericos',
                'descripcion' => 'Teclados, ratones y accesorios de entrada para estaciones de trabajo.',
                'estado' => 'activo',
                'productos' => [
                    ['nombre' => 'Logitech MX Master 3S', 'descripcion' => 'Mouse ergonomico inalambrico orientado a productividad.', 'precio' => 115.00, 'stock' => 12],
                    ['nombre' => 'Keychron K8 Pro', 'descripcion' => 'Teclado mecanico hot-swappable con conectividad Bluetooth.', 'precio' => 139.00, 'stock' => 4],
                ],
            ],
            [
                'nombre' => 'Almacenamiento',
                'descripcion' => 'Unidades SSD, discos externos y soluciones para respaldo seguro.',
                'estado' => 'activo',
                'productos' => [
                    ['nombre' => 'Samsung 990 EVO 1TB', 'descripcion' => 'SSD NVMe de alto rendimiento para sistemas y proyectos pesados.', 'precio' => 129.00, 'stock' => 9],
                    ['nombre' => 'WD Elements 2TB', 'descripcion' => 'Disco externo USB para copias de seguridad y archivos multimedia.', 'precio' => 84.00, 'stock' => 6],
                ],
            ],
            [
                'nombre' => 'Redes',
                'descripcion' => 'Equipos de conectividad para laboratorios y oficinas de tamaño medio.',
                'estado' => 'activo',
                'productos' => [
                    ['nombre' => 'TP-Link Archer AX55', 'descripcion' => 'Router Wi-Fi 6 con buena cobertura para entornos domesticos y pequeños negocios.', 'precio' => 148.00, 'stock' => 3],
                    ['nombre' => 'Switch TP-Link TL-SG108', 'descripcion' => 'Switch gigabit de 8 puertos para ampliar la red local.', 'precio' => 52.00, 'stock' => 10],
                ],
            ],
            [
                'nombre' => 'Componentes',
                'descripcion' => 'Piezas clave para armado y actualizacion de equipos informaticos.',
                'estado' => 'activo',
                'productos' => [
                    ['nombre' => 'Corsair Vengeance 32GB DDR5', 'descripcion' => 'Kit de memoria para estaciones de desarrollo y renderizado.', 'precio' => 176.00, 'stock' => 7],
                    ['nombre' => 'MSI MAG A750GL', 'descripcion' => 'Fuente de poder ATX 3.0 certificada 80 Plus Gold.', 'precio' => 142.00, 'stock' => 2],
                ],
            ],
        ];

        foreach ($dataset as $item) {
            $productos = $item['productos'];
            unset($item['productos']);

            $categoria = Categoria::updateOrCreate(
                ['nombre' => $item['nombre']],
                $item,
            );

            foreach ($productos as $producto) {
                Producto::updateOrCreate(
                    ['nombre' => $producto['nombre']],
                    [...$producto, 'categoria_id' => $categoria->id],
                );
            }
        }
    }
}
