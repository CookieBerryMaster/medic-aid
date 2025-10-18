<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit_logs extends Model
{
    protected $table = 'audit_logs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'usuario_id',
        'accion',
        'detalles',
        'created_at',
    ];
}
