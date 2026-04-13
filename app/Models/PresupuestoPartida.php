<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    public function ajustes()
    {
        return $this->hasMany(AjustePresupuesto::class, 'id_presupuesto_partida');
    }

    public function totalConAjustes()
    {
        $incrementos = $this->ajustes()
            ->where('tipo', 'incremento')
            ->sum('cantidad');

        $disminuciones = $this->ajustes()
            ->where('tipo', 'disminucion')
            ->sum('cantidad');

        return $this->presupuesto + $incrementos - $disminuciones;
    }


    public function scopeConTotal($query)
    {
        $ajustes = DB::table('presupuesto_ajuste')
            ->selectRaw("
                id_presupuesto_partida,
                SUM(
                    CASE
                        WHEN tipo = 'incremento' THEN importe
                        WHEN tipo = 'disminucion' THEN -importe
                    END
                ) as total_ajustes
            ")
            ->groupBy('id_presupuesto_partida');

        return $query
            ->leftJoinSub($ajustes, 'ajustes', function ($join) {
                $join->on('presupuesto_partidas.id', '=', 'ajustes.id_presupuesto_partida');
            })
            ->addSelect('presupuesto_partidas.*')
            ->addSelect(DB::raw("
                presupuesto_partidas.presupuesto + COALESCE(ajustes.total_ajustes,0) as total_ajustado
            "));
    }


}
