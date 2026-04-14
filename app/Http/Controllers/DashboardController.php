<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalCategorias = Categoria::count();
        $totalProductos = Producto::count();
        $valorInventario = (float) Producto::query()
            ->selectRaw('COALESCE(SUM(precio * stock), 0) as total')
            ->value('total');
        $productosBajoStock = Producto::where('stock', '<=', 5)->count();
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
