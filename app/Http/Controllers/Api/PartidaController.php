<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\Bitacora;

class PartidaController extends Controller
{
    public function getPartidas(Request $request){
        //$partidas = Partida::whereNull('padre_id')->orderBy('id','asc')->get();
        //return $partidas;

        $query = Partida::query();

        $query->when($request->busqueda != null, function($b) use ($request){
            // PostgreSQL's LIKE operator is case-sensitive by default. To perform a case-insensitive search, use the ILIKE operator.
            $b->where('nombre', 'ILIKE', '%'.$request->busqueda .'%');
        });

        $partidas = $query->whereNull('padre_id')->orderBy('id','desc')->get();

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
            'nombre' => $this->limpiarNombre($request->nombre),
            'padre_id' => $request->padre_id,
            'creado_por'  => $request->creado_por
        ]);

        // Bitacora
        $bitacora = new Bitacora();
        $bitacora->usuario = $request->creado_por;
        $bitacora->descripcion = 'Se creo la partida '.$request->nombre;
        $partida->bitacora()->save($bitacora);
    
        return $partida;
    }

    public function updatePartida(Request $request){
        $partida = Partida::findOrFail($request->id);
        $old_nombre = $partida->nombre;
        $partida->nombre            = $this->limpiarNombre($request->nombre);
        $partida->padre_id          = $request->padre_id;
        $partida->actualizado_por   = $request->actualizado_por;
        $partida->save();
        
        // Bitacora
        $bitacora = new Bitacora();
        $bitacora->usuario = $request->actualizado_por;
        $bitacora->descripcion = 'Se actualizo la partida '.$old_nombre.' a ' .$partida->nombre;
        $partida->bitacora()->save($bitacora);

        return $partida;
    }

    public function deletepartida(Request $request){
        $id = $request->id;
        $partida = Partida::findOrFail($id);
        $partida->delete();
        
        // Bitacora
        $bitacora = new Bitacora();
        $bitacora->usuario = $request->eliminado_por;
        $bitacora->descripcion = 'Se elimino la partida '.$partida->nombre;
        $partida->bitacora()->save($bitacora);

        return $partida;
    }

    public function getAllPartidas(){
        $partidas = Partida::with('hijos')->get();
        return $partidas;
    }

    public function getPartidasInicial(){
        $partidas = Partida::whereNull('padre_id')->orderBy('id','asc')->get();
        return $partidas;
    }

    public function getPartidasByPadre(Request $request){
        $id = $request->id;
        $partidas = Partida::where('padre_id', $id)->get();
        return $partidas;
    }

    private function limpiarNombre($nombre)
    {
        $nombre = str_replace('_', ' ', $nombre);

        // Forzar UTF-8 correcto
        $nombre = mb_convert_encoding($nombre, 'UTF-8', 'UTF-8');

        // Convertir a mayúsculas respetando acentos
        return mb_strtoupper($nombre, 'UTF-8');
    }
}
