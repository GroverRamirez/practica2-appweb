<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Categoria;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = trim((string) $request->query('buscar', ''));

        $productos = $this->productosQuery($buscar)
            ->latest()
            ->paginate(7)
            ->withQueryString();

        return view('productos.index', compact('productos', 'buscar'));
    }

    public function create(): View
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('productos.create', compact('categorias'));
    }

    public function store(StoreProductoRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create($data);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function edit(Producto $producto): View
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(UpdateProductoRequest $request, Producto $producto): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }

            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($data);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto): RedirectResponse
    {
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    public function reportePdf()
    {
        $productos = Producto::with('categoria')
            ->orderBy('nombre')
            ->get();
        $fechaGeneracion = now();

        $pdf = Pdf::loadView('productos.reporte-pdf', compact('productos', 'fechaGeneracion'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('reporte-productos.pdf');
    }

    public function reporteExcel(Request $request): Response
    {
        $buscar = trim((string) $request->query('buscar', ''));
        $productos = $this->productosQuery($buscar)
            ->orderBy('nombre')
            ->get();
        $fechaGeneracion = now();
        $nombreArchivo = 'reporte-productos-'.now()->format('Ymd-His').'.xls';

        return response()
            ->view('productos.reporte-excel', compact('productos', 'fechaGeneracion', 'buscar'))
            ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$nombreArchivo.'"');
    }

    private function productosQuery(string $buscar)
    {
        return Producto::with('categoria')
            ->when($buscar !== '', function ($query) use ($buscar) {
                $query->where(function ($subquery) use ($buscar) {
                    $subquery
                        ->where('nombre', 'like', "%{$buscar}%")
                        ->orWhere('descripcion', 'like', "%{$buscar}%")
                        ->orWhereHas('categoria', function ($categoriaQuery) use ($buscar) {
                            $categoriaQuery->where('nombre', 'like', "%{$buscar}%");
                        });
                });
            });
    }
}
