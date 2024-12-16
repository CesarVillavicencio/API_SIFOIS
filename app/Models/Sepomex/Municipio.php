<?php

namespace App\Models\Sepomex;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model {
    protected $table = 'municipios';

    protected $fillable = ['name', 'entidad_id', 'number'];
}
