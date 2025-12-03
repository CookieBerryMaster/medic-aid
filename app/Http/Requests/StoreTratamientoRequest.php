<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTratamientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'usuario_id' => 'required|exists:usuarios,id',

            'medicamentos' => 'required|array|min:1',
            'medicamentos.*.medicamento_id' => 'required|exists:medicamentos,id', // 👈 CAMBIO
            'medicamentos.*.dosis' => 'nullable|string|max:255',

            'frecuencia_horas' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'hora_inicio' => 'required|date_format:H:i',
            'notas' => 'nullable|string',
        ];
    }

}
