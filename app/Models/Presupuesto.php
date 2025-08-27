<?php

namespace App\Models;

use App\Models\PresupuestoPartida;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presupuesto extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'presupuestos';
    protected $fillable = ['periodo', 'year', 'id_municipio', 'creado_por', 'actualizado_por', 'serie'];

    protected $casts = [
        'id_municipio' => 'array',
    ];

    protected $appends = ['ejercido', 'presupuestado']; 

    public function bitacora()
    {
        return $this->morphMany(Bitacora::class, 'morphable');
    }

    public function getPresupuesto(){
        $data = PresupuestoPartida::where('id_presupuesto', $this->id)->get();
        return $data->sum('presupuesto');
    }

    public function getEjercido(){
        $data = PresupuestoCI::where('id_presupuesto', $this->id)->get();
        return $data->sum('importe');
    }

    public function getEjercidoAttribute()
    {
        return $this->getEjercido();
    }

    public function getPresupuestadoAttribute()
    {
        return $this->getPresupuesto();
    }
}
