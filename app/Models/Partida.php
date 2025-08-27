<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partida extends Model
{
    use HasFactory;
    
    protected $table = 'partidas';
    protected $fillable = ['nombre', 'padre_id', 'creado_por', 'actualizado_por'];

    // An partidas belongs to a partidas (who is also an partidas)
    public function padres()
    {
        return $this->belongsTo(Self::class, 'padre_id');
    }

    public function allPadres()
    {
        return $this->padres()->with('allPadres');
    }

    // An partida can have many partidas (other partidas)
    public function hijos()
    {
        return $this->hasMany(Self::class, 'padre_id');
    }

    public function getAllParents()
    {
        $parents = collect([]);
        // Add itSelf
        $parents->push($this);
        $parent = $this->padres;

        while(!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->padres;
        }
        return $parents;
    }

    public function ultimoPadre()
    {
        $partida = $this;
        while ($partida->padre) {
            $partida = $partida->padre;
        }
        return $partida;
    }

    public function ultimoPadreRelationship()
    {
        if ($this->relationLoaded('padre')) {
            $padre = $this->getRelation('padre');
        } else {
            $padre = $this->padre;
        }

        $current = $this;
        while ($current->padre) {
            $current = $current->padre;
        }

        // Guardar manualmente como relación cargada
        $this->setRelation('ultimoPadre', $current);

        // Simular una relación válida
        return $this->hasOne(Partida::class, 'id', 'id')->where('id', $current->id);
    }

    public function obtenerJerarquiaPadres()
    {
        $jerarquia = [];
        $actual = $this;
        while ($actual->padres) {
            // dd($actual);
            $actual = $actual->padres;
            $jerarquia[] = $actual->nombre;
        }

        return array_reverse($jerarquia); // Desde el más lejano al inmediato
    }

    public function bitacora()
    {
        return $this->morphMany(Bitacora::class, 'morphable');
    }


}
