<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Test\ShonyTest;
use App\Http\Controllers\Test\ChiliTest;

class TestController extends Controller {

    public function test() {
        $test = null;
        
        // if (env('TEST_CLASS_USER') == 'SHONY') {
            $test = ChiliTest::test();
        // }

        return response()->json($test);
    }
}