<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Administra el CRUD de categorias y sus reportes.
 */
class CategoriaController extends Controller
{
    /**
     * Lista categorias con busqueda, conteo de productos y paginacion.
     */
    public function index(Request $request): View
    {
        $buscar = trim((string) $request->query('buscar', ''));

        $categorias = $this->categoriasQuery($buscar)
            ->withCount('productos')
            ->orderByDesc('id')
            ->paginate(7)
            ->withQueryString();

        return view('categorias.index', compact('categorias', 'buscar'));
    }

    /**
     * Muestra el formulario para registrar una nueva categoria.
     */
    public function create(): View
    {
        return view('categorias.create');
    }

    /**
     * Guarda una categoria nueva y le asigna estado activo por defecto.
     */
    public function store(StoreCategoriaRequest $request): RedirectResponse
    {
        Categoria::create([
            ...$request->validated(),
            'estado' => 'activo',
        ]);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria creada correctamente.');
    }

    /**
     * Carga el formulario de edicion con la categoria seleccionada.
     */
    public function edit(Categoria $categoria): View
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Actualiza los datos editables de una categoria existente.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria): RedirectResponse
    {
        $categoria->update($request->validated());

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria actualizada correctamente.');
    }

    /**
     * Elimina la categoria y limpia las imagenes asociadas a sus productos.
     */
    public function destroy(Categoria $categoria): RedirectResponse
    {
        $categoria->load('productos');

        // Antes de borrar la categoria se eliminan los archivos fisicos relacionados.
        foreach ($categoria->productos as $producto) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
        }

        $categoria->delete();

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria eliminada correctamente.');
    }

    /**
     * Genera un reporte PDF ordenado alfabeticamente.
     */
    public function reportePdf()
    {
        $categorias = Categoria::withCount('productos')
            ->orderBy('nombre')
            ->get();
        $fechaGeneracion = now();

        $pdf = Pdf::loadView('categorias.reporte-pdf', compact('categorias', 'fechaGeneracion'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('reporte-categorias.pdf');
    }

    /**
     * Exporta un archivo Excel compatible con los filtros aplicados en el index.
     */
    public function reporteExcel(Request $request): Response
    {
        $buscar = trim((string) $request->query('buscar', ''));
        $categorias = $this->categoriasQuery($buscar)
            ->withCount('productos')
            ->orderBy('nombre')
            ->get();
        $fechaGeneracion = now();
        $nombreArchivo = 'reporte-categorias-'.now()->format('Ymd-His').'.xls';

        return response()
            ->view('categorias.reporte-excel', compact('categorias', 'fechaGeneracion', 'buscar'))
            ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$nombreArchivo.'"');
    }

    /**
     * Centraliza la consulta base para reutilizar la misma logica en lista y reportes.
     */
    private function categoriasQuery(string $buscar)
    {
        return Categoria::query()->when($buscar !== '', function ($query) use ($buscar) {
            $query->where(function ($subquery) use ($buscar) {
                $subquery
                    ->where('nombre', 'like', "%{$buscar}%")
                    ->orWhere('descripcion', 'like', "%{$buscar}%")
                    ->orWhere('estado', 'like', "%{$buscar}%");
            });
        });
    }
}
