<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AjustePresupuesto extends Model
{
    protected $table = 'presupuesto_ajuste';
    protected $fillable = ['id_presupuesto_partida', 'tipo', 'importe'];
}
