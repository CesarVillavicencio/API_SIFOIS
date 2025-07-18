<?php

namespace App\Models;

use App\Models\Sepomex\Municipio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresupuestoPartida extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'presupuesto_partidas';
    protected $fillable = ['id_presupuesto', 'id_partida', 'presupuesto'];

    public function presu()
    {
        return $this->belongsTo(Presupuesto::class, 'id_presupuesto');
    }

    public function partida()
    {
        return $this->belongsTo(Partida::class, 'id_partida');
    }



}
