<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Pagina publica inicial del sistema.
Route::view('/', 'welcome')->name('welcome');

Route::middleware('auth')->group(function () {
    // Panel principal con metricas del inventario.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Reportes del modulo categorias.
    Route::get('/categorias/reporte/pdf', [CategoriaController::class, 'reportePdf'])->name('categorias.reporte.pdf');
    Route::get('/categorias/reporte/excel', [CategoriaController::class, 'reporteExcel'])->name('categorias.reporte.excel');
    Route::resource('categorias', CategoriaController::class)->except(['show']);

    // Reportes del modulo productos.
    Route::get('/productos/reporte/pdf', [ProductoController::class, 'reportePdf'])->name('productos.reporte.pdf');
    Route::get('/productos/reporte/excel', [ProductoController::class, 'reporteExcel'])->name('productos.reporte.excel');
    Route::resource('productos', ProductoController::class)->except(['show']);

    // Perfil del usuario autenticado.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
