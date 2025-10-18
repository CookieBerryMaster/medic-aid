<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = 'historial';

    protected $fillable = [
        'tratamiento_id',
        'fecha_hora',
        'estado',
        'notas',
    ];

    // Relaciones
    public function tratamientos()
    {
        return $this->belongsTo(Tratamientos::class);
    }
}
