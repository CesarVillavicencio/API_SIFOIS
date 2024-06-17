<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Test\ShonyTest;

class TestController extends Controller {

    public function test() {
        $test = null;
        
        if (env('TEST_CLASS_USER') == 'SHONY') {
            $test = ShonyTest::test();
        }

        return response()->json($test);
    }
}