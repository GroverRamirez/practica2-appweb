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

class CategoriaController extends Controller
{
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

    public function create(): View
    {
        return view('categorias.create');
    }

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

    public function edit(Categoria $categoria): View
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria): RedirectResponse
    {
        $categoria->update($request->validated());

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria actualizada correctamente.');
    }

    public function destroy(Categoria $categoria): RedirectResponse
    {
        $categoria->load('productos');

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
