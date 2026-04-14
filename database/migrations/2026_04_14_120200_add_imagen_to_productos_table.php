<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Campo opcional para guardar la ruta del archivo de imagen del producto.
        Schema::table('productos', function (Blueprint $table) {
            $table->string('imagen')->nullable();
        });
    }

    public function down(): void
    {
        // Revierte la ampliacion del modulo productos quitando la imagen.
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
};
