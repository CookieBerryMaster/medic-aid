<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Medicamento;

//descomentar cuando se creen los modelos Usuarios y Medicamentos
// use App\Models\Usuarios;
// use App\Models\Medicamentos;
class Tratamientos extends Model
{
    protected $table = 'tratamientos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'usuario_id',
        'medicamento_id',
        'dosis',
        'frecuencia_horas',
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'notas',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id');
    }

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'medicamento_id', 'id');
    }
}
