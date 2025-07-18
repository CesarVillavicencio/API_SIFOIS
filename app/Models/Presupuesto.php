<?php

namespace App\Models;

use App\Models\Sepomex\Municipio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presupuesto extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'presupuestos';
    protected $fillable = ['periodo', 'year', 'id_municipio'];

    protected $casts = [
        'id_municipio' => 'array',
    ];


}
