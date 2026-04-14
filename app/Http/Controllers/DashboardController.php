<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\View\View;

/**
 * Construye las metricas principales que se muestran al ingresar al sistema.
 */
class DashboardController extends Controller
{
    /**
     * Resume el estado actual del inventario para el panel principal.
     */
    public function index(): View
    {
        // Indicadores globales que se muestran en las tarjetas del dashboard.
        $totalCategorias = Categoria::count();
        $totalProductos = Producto::count();
        $valorInventario = (float) Producto::query()
            ->selectRaw('COALESCE(SUM(precio * stock), 0) as total')
            ->value('total');
        $productosBajoStock = Producto::where('stock', '<=', 5)->count();

        // Listado breve para mostrar actividad reciente en el panel.
        $ultimosProductos = Producto::with('categoria')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalCategorias',
            'totalProductos',
            'valorInventario',
            'productosBajoStock',
            'ultimosProductos',
        ));
    }
}
