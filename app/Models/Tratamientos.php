<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Medicamento;

class Tratamientos extends Model
{
    protected $table = 'tratamientos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario_id',
        'frecuencia_horas',
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'notas',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function medicamentos()
    {
        return $this->belongsToMany(
            Medicamento::class,
            'medicamento_tratamiento',
            'tratamiento_id',   // nombre correcto en la tabla pivote
            'medicamento_id'    // nombre correcto en la tabla pivote
        )
        ->withPivot('dosis');
    }

}
