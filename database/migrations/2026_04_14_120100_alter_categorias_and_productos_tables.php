<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // La descripcion de categoria pasa a ser opcional.
        Schema::table('categorias', function (Blueprint $table) {
            $table->text('descripcion')->nullable()->change();
        });

        // En productos se flexibiliza descripcion y se fija precision monetaria.
        Schema::table('productos', function (Blueprint $table) {
            $table->text('descripcion')->nullable()->change();
            $table->decimal('precio', 10, 2)->change();
        });
    }

    public function down(): void
    {
        // Restaura la obligatoriedad original de descripcion en categorias.
        Schema::table('categorias', function (Blueprint $table) {
            $table->text('descripcion')->nullable(false)->change();
        });

        // Devuelve la definicion previa de productos.
        Schema::table('productos', function (Blueprint $table) {
            $table->text('descripcion')->nullable(false)->change();
            $table->decimal('precio', 8, 2)->change();
        });
    }
};
