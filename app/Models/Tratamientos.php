<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Medicamento;

class Tratamientos extends Model
{
    protected $table = 'tratamientos';
    protected $primaryKey = 'id';

    // La tabla tiene created_at y updated_at, así que mejor lo dejamos activado
    public $timestamps = true;

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
            'tratamiento_id',
            'medicamento_id'
        )->withPivot('dosis');
    }
}
