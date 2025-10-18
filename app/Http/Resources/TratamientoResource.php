<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TratamientoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'medicamento_id' => $this->medicamento_id,
            'dosis' => $this->dosis,
            'frecuencia' => $this->frecuencia,
            'duracion' => $this->duracion,
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

            'medicamento' => $this->whenLoaded('medicamento', function () {
                return [
                    'id' => $this->medicamento->id,
                    'nombre' => $this->medicamento->nombre,
                    'tipo' => $this->medicamento->tipo,
                    'dosis_default' => $this->medicamento->dosis_default,
                ];
            }),
            
        ];
    }
}
