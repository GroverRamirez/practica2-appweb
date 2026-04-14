<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Valida los datos enviados al registrar una nueva categoria.
 */
class StoreCategoriaRequest extends FormRequest
{
    /**
     * En esta practica cualquier usuario autenticado puede usar el formulario.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas minimas para garantizar consistencia de datos.
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
        ];
    }
}
