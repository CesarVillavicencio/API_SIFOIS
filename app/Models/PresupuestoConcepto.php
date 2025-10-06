<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresupuestoConcepto extends Model
{
    use SoftDeletes;

    protected $table = 'presupuesto_concepto';
    protected $fillable = ['id_presupuesto', 'concepto', 'importe'];

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class, 'id_presupuesto');
    }
}
