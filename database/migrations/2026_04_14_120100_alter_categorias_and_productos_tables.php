<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->text('descripcion')->nullable()->change();
        });

        Schema::table('productos', function (Blueprint $table) {
            $table->text('descripcion')->nullable()->change();
            $table->decimal('precio', 10, 2)->change();
        });
    }

    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->text('descripcion')->nullable(false)->change();
        });

        Schema::table('productos', function (Blueprint $table) {
            $table->text('descripcion')->nullable(false)->change();
            $table->decimal('precio', 8, 2)->change();
        });
    }
};
