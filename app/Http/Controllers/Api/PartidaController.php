<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partida;

class PartidaController extends Controller
{
    public function getPartidas(){
        $partidas = Partida::whereNull('padre_id')->get();
        return $partidas;
    }

    public function getPartida(Request $request){
        $partidas = Partida::with('allPadres')->where('padre_id', $request->id)->get();
        return $partidas;
    }

    public function getPadres(Request $request){
        $partida = Partida::findOrFail($request->id);
        return $partida->getAllParents()->toArray();
    }

    public function createPartida(Request $request){
        $partida = Partida::create([
            'nombre' => $request->nombre,
            'padre_id' => $request->padre_id,
            'presupuesto' => $request->presupuesto
        ]);

        return $partida;
    }

    public function updatePartida(Request $request){
        $partida = Partida::findOrFail($request->id);
        $partida->nombre        = $request->nombre;
        $partida->padre_id      = $request->padre_id;
        $partida->presupuesto   = $request->presupuesto;
        $partida->save();
        
        return $partida;
    }

    public function deletepartida(Request $request){
        $id = $request->id;
        $partida = Partida::findOrFail($id);
        $partida->delete();
        
        return $partida;
    }
}
