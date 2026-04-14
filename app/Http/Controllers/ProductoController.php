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

/**
 * Administra el CRUD de productos, imagenes y reportes.
 */
class ProductoController extends Controller
{
    /**
     * Lista productos con su categoria, busqueda y paginacion.
     */
    public function index(Request $request): View
    {
        $buscar = trim((string) $request->query('buscar', ''));

        $productos = $this->productosQuery($buscar)
            ->latest()
            ->paginate(7)
            ->withQueryString();

        return view('productos.index', compact('productos', 'buscar'));
    }

    /**
     * Muestra el formulario de registro con las categorias disponibles.
     */
    public function create(): View
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('productos.create', compact('categorias'));
    }

    /**
     * Guarda el producto y almacena la imagen en disco si fue enviada.
     */
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

    /**
     * Carga el formulario de edicion con el producto y sus categorias.
     */
    public function edit(Producto $producto): View
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Reemplaza la imagen anterior si el usuario sube una nueva version.
     */
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

    /**
     * Elimina el registro y su archivo de imagen asociado.
     */
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

    /**
     * Genera un reporte PDF horizontal para aprovechar mejor la tabla.
     */
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

    /**
     * Exporta un archivo Excel compatible con el filtro usado en el listado.
     */
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

    /**
     * Reutiliza la misma consulta base en el index y en los reportes.
     */
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
