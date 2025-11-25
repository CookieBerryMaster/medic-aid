<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHistorialRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tratamiento_id' => 'sometimes|integer|exists:tratamientos,id',
            'fecha_hora'     => 'sometimes|date',
            'estado'         => 'sometimes|string',
            'notas'          => 'nullable|string',
        ];
    }
}
