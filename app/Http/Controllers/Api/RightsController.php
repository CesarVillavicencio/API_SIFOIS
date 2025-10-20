<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRights;


class RightsController extends Controller
{
    public function getUsers(){
        $users  = UserRights::distinct('usuario')->select('usuario')->paginate(20);
        return $users;
    }

    public function getDerechos(Request $request){
        $user = $request->usuario;
        $rights  = UserRights::where('usuario', $user)->get()->groupBy('modulo');
        
        return $rights;
    }    

    public function getRights(Request $request){
        $user = $request->usuario;
        $rights = UserRights::where('usuario', $user)->get();
        $derechos = [];

        if($rights->isEmpty()){
            $rights = self::createRights($user);
        }

        foreach ($rights as $key => $r) {
           $derechos[$r['modulo']][$r['action']] = $r['value'];
        }
        return ['rights' => $derechos];
    }

    public static function createRights($user){
        $modules = ['Beneficiarios','Partidas','Presupuestos'];
        $actions = ['can_create','can_update','can_delete'];

        foreach ($modules as $key => $m) {
            foreach ($actions as $key => $a) {
                UserRights::create([
                    'usuario'=> $user,
                    'modulo' => $m,
                    'action' => $a,
                    'value' => false
                ]);
            }
        }
        $rights =  UserRights::where('usuario', $user)->get();
        return $rights;
    }

    public function toggleRight(Request $request){
        $right = UserRights::findOrFail($request->id);
        $right->value = $right->value ? false:true;
        $right->save();

        return $this->getRights($request);
    }
}
