<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresupuestoCI extends Model
{
    use SoftDeletes;

    protected $table = 'presupuesto_ci';
    protected $fillable = ['id_presupuesto', 'id_partida', 'ci', 'id_beneficiario', 'tipo_cambio', 'presupuestado', 'importe_meses', 'importe', 'concepto', 'observaciones', 'fecha', 'creado_por', 'actualizado_por'];

    protected $casts = [
        'importe_meses' => 'array',
    ];

    public function presu()
    {
        return $this->belongsTo(Presupuesto::class, 'id_presupuesto');
    }

    public function partida()
    {
        return $this->belongsTo(Partida::class, 'id_partida');
    }

    public function beneficiario()
    {
        return $this->belongsTo(Beneficiario::class, 'id_beneficiario');
    }
}
