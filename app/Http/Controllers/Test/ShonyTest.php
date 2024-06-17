<?php

namespace App\Http\Controllers\Test;

use App\Models\User;

class ShonyTest {

    public static function test(): mixed {

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        return true;
    }
}
