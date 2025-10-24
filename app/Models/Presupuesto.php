<?php

namespace App\Models;

use App\Models\Sepomex\Municipio;
use App\Models\PresupuestoPartida;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presupuesto extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'presupuestos';
    protected $fillable = ['periodo', 'year', 'id_municipio', 'creado_por', 'actualizado_por', 'serie', 'fecha'];

    protected $casts = [
        'id_municipio' => 'array',
        // 'fecha' => 'datetime', 
    ];


    protected $appends = ['ejercido', 'presupuestado']; 

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }
    
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

    public function presupuestoCI()
    {
        return $this->hasMany(PresupuestoCI::class, 'id_presupuesto');
    }

    public function conceptos(){
        return $this->hasMany(PresupuestoConcepto::class, 'id_presupuesto');
    }

    public function presupuestoPartida(){
        return $this->hasMany(PresupuestoPartida::class, 'id_presupuesto');
    }

     protected static function booted()
        {
            static::deleting(function (Presupuesto $post) {
                // Soft delete related ci
                $post->presupuestoCI()->each(function ($ci) {
                    $ci->delete();
                });

                //Soft delete  related conceptos
                $post->conceptos()->each(function ($concepto) {
                    $concepto->delete();
                });

                //Soft delete  related presupuesto partidas
                $post->presupuestoPartida()->each(function ($partida) {
                    $partida->delete();
                });
            });

            static::restoring(function (Presupuesto $post) {
                // Restore related CIs (only if they were also soft deleted)
                $post->presupuestoCI()->withTrashed()->each(function ($ci) {
                    $ci->restore();
                });
                // Restore related conceptos (only if they were also soft deleted)
                $post->conceptos()->withTrashed()->each(function ($concepto) {
                    $concepto->restore();
                });
                // Restore related presupuestoPartidas (only if they were also soft deleted)
                $post->presupuestoPartida()->withTrashed()->each(function ($partida) {
                    $partida->restore();
                });
                
            });
        }
}
