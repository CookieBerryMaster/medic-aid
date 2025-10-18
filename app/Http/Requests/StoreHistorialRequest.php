<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHistorialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tratamiento_id' => 'required|exists:tratamientos,id',
            'fecha_hora'     => 'required|date',
            'estado'         => 'nullable|in:pendiente,tomada,omitida',
            'notas'          => 'nullable|string',
        ];
    }
}
