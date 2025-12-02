<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tratamientos;

class Medicamento extends Model
{
    use HasFactory;

    protected $table = 'medicamentos';

    protected $fillable = [
        'nombre',
        'tipo',
        'dosis_default', // 👈 AQUÍ EL CAMBIO
    ];

    public function tratamientos()
    {
        return $this->belongsToMany(
            Tratamientos::class,
            'medicamento_tratamiento',
            'medicamento_id',
            'tratamiento_id'
        )->withPivot('dosis');
    }
}
