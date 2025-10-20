<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    public function getBitacora(Request $request){
    
        if($request->has('tipo')){
            $type = 'App\Models\\'.$request->tipo;
            $data = Bitacora::where('morphable_type', $type)->orderBy('id','desc')->get();
        }
        else{
            $data = Bitacora::all();
        }

        return $data;
    }

    public function getBitacoraByID(Request $request){
    
        $id = $request->id;
        $data = Bitacora::where('morphable_type', 'App\Models\\'.$request->tipo)->where('morphable_id', $id)->orderBy('id','desc')->get();

        return $data;
    }
}
