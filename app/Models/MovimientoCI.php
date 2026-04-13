<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovimientoCI extends Model
{
    use SoftDeletes;

    protected $table = 'presupuesto_ci_movimientos';
    protected $fillable = ['id_presupuesto_ci', 'mes', 'importe', 'fecha'];


    public function presupuestoCI()
    {
        return $this->belongsTo(PresupuestoCI::class, 'id_presupuesto_ci');
    }
}
