<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Representa un producto del inventario y su relacion con una categoria.
 */
class Producto extends Model
{
    use HasFactory;

    /**
     * Campos que pueden llenarse directamente desde el formulario validado.
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria_id',
        'imagen',
    ];

    /**
     * Convierte precio a decimal con dos decimales al recuperar el modelo.
     */
    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
        ];
    }

    /**
     * Cada producto pertenece a una sola categoria.
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Devuelve una URL lista para mostrar la imagen o un avatar por defecto.
     */
    public function getImagenUrlAttribute(): string
    {
        if ($this->imagen) {
            return asset('storage/'.$this->imagen);
        }

        return 'https://ui-avatars.com/api/?name='
            .urlencode($this->nombre)
            .'&background=f1f5f9&color=64748b&size=128';
    }
}
