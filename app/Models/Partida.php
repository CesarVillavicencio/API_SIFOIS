<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partida extends Model
{
    use HasFactory;
    
    protected $table = 'partidas';
    protected $fillable = ['nombre', 'padre_id'];

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
}
