<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuditResource extends JsonResource
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
            'accion' => $this->accion,
            'detalles' => $this->detalles,
            'created_at' => $this->created_at,

             'usuario' => $this->whenLoaded('usuario', function () {
                return [
                    'id' => $this->usuario->id,
                    'nombre' => $this->usuario->nombre,
                    'apellido' => $this->usuario->apellido,
                    'email' => $this->usuario->email,
                ];
            }),
        ];
    }
}
