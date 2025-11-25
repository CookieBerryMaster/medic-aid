<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHistorialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tratamiento_id' => 'sometimes|exists:tratamientos,id',
            'fecha_hora'     => 'sometimes|date',
            'estado'         => 'sometimes|in:pendiente,tomada,omitida',
            'notas'          => 'sometimes|string|nullable',
        ];
    }
}
