<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTratamientoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'usuario_id' => 'sometimes|exists:usuarios,id',
            'medicamento_id' => 'sometimes|exists:medicamentos,id',
            'dosis' => 'sometimes|string|max:255',
            'frecuencia_horas' => 'sometimes|integer|min:1',
            'fecha_inicio' => 'sometimes|date',
            'fecha_fin' => 'sometimes|date|after_or_equal:fecha_inicio',
            'hora_inicio' => 'sometimes|date_format:H:i',
            'notas' => 'nullable|string',
        ];
    }
}
