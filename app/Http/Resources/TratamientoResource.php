<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TratamientoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'frecuencia_horas' => $this->frecuencia_horas,
            'notas' => $this->notas,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'usuario' => $this->whenLoaded('usuario', function () {
                return [
                    'id' => $this->usuario->id,
                    'nombre' => $this->usuario->nombre,
                    'apellido' => $this->usuario->apellido,
                    'email' => $this->usuario->email,
                ];
            }),

            'medicamentos' => $this->whenLoaded('medicamentos', function () {
                return $this->medicamentos->map(function ($med) {
                    return [
                        'id' => $med->id,
                        'nombre' => $med->nombre,
                        'tipo' => $med->tipo,
                        'concentracion' => $med->concentracion,
                        'dosis' => $med->pivot->dosis,
                    ];
                });
            }),
        ];
    }
}
