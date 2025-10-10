<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beneficiario extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'beneficiarios';
    protected $fillable = ['nombre', 'apellido', 'creado_por', 'actualizado_por'];

    public function getFullNameAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }

    public function bitacora()
    {
        return $this->morphMany(Bitacora::class, 'morphable');
    }
}
