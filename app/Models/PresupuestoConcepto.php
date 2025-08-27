<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresupuestoConcepto extends Model
{
    protected $table = 'presupuesto_concepto';
    protected $fillable = ['id_presupuesto', 'concepto', 'importe'];

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class, 'id_presupuesto');
    }
}
