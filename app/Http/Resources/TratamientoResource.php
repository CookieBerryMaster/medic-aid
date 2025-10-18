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
            /* descomentar cuando existan las relaciones
            'usuario' => $this->whenLoaded('usuario', function () {
                return [
                    'id' => $this->usuario->usuario_id,
                    'nombre' => $this->usuario->nombre,
                    'apellido' => $this->usuario->apellido,
                    'email' => $this->usuario->email,
                    'tipo' => $this->usuario->tipo,
                ];
            }),

            'medicamento' => $this->whenLoaded('medicamento', function () {
                return [
                    'id' => $this->medicamento->medicamento_id,
                    'nombre' => $this->medicamento->nombre,
                    'descripcion' => $this->medicamento->descripcion,
                    'efectos_secundarios' => $this->medicamento->efectos_secundarios,
                ];
            }),
            */
        ];
    }
}
