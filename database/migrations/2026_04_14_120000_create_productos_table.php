<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla principal del inventario, relacionada con categorias.
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion');
            $table->decimal('precio');
            $table->integer('stock');
            // Al eliminar una categoria, sus productos tambien se eliminan.
            $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Revierte la creacion completa de la tabla productos.
        Schema::dropIfExists('productos');
    }
};
