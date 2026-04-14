<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Valida la edicion de productos sin romper relaciones ni archivos.
 */
class UpdateProductoRequest extends FormRequest
{
    /**
     * En esta practica cualquier usuario autenticado puede usar el formulario.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Mantiene las mismas restricciones de la creacion para conservar integridad.
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}
