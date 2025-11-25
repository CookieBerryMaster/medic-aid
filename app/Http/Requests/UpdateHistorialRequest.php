<?php

// !!
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UpdateHistorialRequest extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'tratamiento_id' => $this->tratamiento_id,
            'fecha_hora'     => $this->fecha_hora,
            'estado'         => $this->estado,
            'notas'          => $this->notas,
            'tratamiento'    => new TratamientoResource($this->whenLoaded('tratamiento')),
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
        ];
    }
}
