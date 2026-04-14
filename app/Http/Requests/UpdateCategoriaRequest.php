<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Valida los cambios realizados sobre una categoria existente.
 */
class UpdateCategoriaRequest extends FormRequest
{
    /**
     * En esta practica cualquier usuario autenticado puede usar el formulario.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Ademas del nombre y descripcion, exige un estado valido.
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'estado' => 'required|in:activo,inactivo',
        ];
    }
}
