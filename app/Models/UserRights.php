<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRights extends Model
{
    protected $table = 'rights';//'user_rights';
    protected $fillable = ['usuario', 'modulo', 'action', 'value'];
}
