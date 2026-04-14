<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria_id',
        'imagen',
    ];

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
        ];
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

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
