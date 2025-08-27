<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacora';
    protected $fillable = ['usuario', 'descripcion', 'morphable_id', 'morphable_type'];

    public function morphable()
    {
        return $this->morphTo();
    }
}
