<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTratamientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'usuario_id' => 'sometimes|exists:usuarios,id',
            'frecuencia_horas' => 'sometimes|integer|min:1',
            'fecha_inicio' => 'sometimes|date',
            'fecha_fin' => 'sometimes|date|after_or_equal:fecha_inicio',
            'hora_inicio' => 'sometimes|date_format:H:i',
            'notas' => 'nullable|string',
        ];
    }
}
