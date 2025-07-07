<?php

namespace App\Models\Sepomex;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model {
    protected $table = 'entidades';

    protected $fillable = ['name', 'abbrev', 'country', 'country'];
}
