<?php

namespace App\Models\Sepomex;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model {
    protected $table = 'entidad';

    protected $fillable = ['name', 'abbrev', 'country'];
}
