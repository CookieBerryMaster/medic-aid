<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'sometimes|required|string|max:100',
            'tipo' => 'nullable|string|max:50',
            'dosis_default' => 'nullable|string|max:50', // 👈 AQUÍ EL CAMBIO
        ];
    }
}
