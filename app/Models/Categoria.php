<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Representa una categoria del catalogo y agrupa varios productos.
 */
class Categoria extends Model
{
    use HasFactory;

    /**
     * Campos permitidos para asignacion masiva desde formularios validados.
     */
    protected $fillable = ['nombre', 'descripcion', 'estado'];

    /**
     * Una categoria puede contener muchos productos.
     */
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }
}
