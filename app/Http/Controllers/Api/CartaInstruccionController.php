<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartaInstruccion;
use App\Models\Sepomex\Municipio;
use Carbon\Carbon;

class CartaInstruccionController extends Controller
{
    public function getMunicipios(){
        $municipios = Municipio::where('entidad_id',3)->get();
        return $municipios;
    }

    public function getCartas(){
        $ci = CartaInstruccion::with('beneficiario', 'partida.allPadres')->paginate(20);
        return $ci;
    }

    public function getCarta(Request $request){
        $id = $request->id;
        $ci = CartaInstruccion::findOrFail($id);
        return $ci;
    }

    public function createCartaInstruccion(Request $request){
        $fecha = Carbon::parse($request->fecha)->format('Y');
        $year = Carbon::parse($fecha)->format('Y');
        $cartas = CartaInstruccion::withTrashed()->whereYear('fecha', $year)->get();
        $ci_id = count($cartas) + 1;
        
        $ci = CartaInstruccion::create([
            'id_partida'        => $request->id_partida,
            'ci'                => $ci_id,
            'id_beneficiario'   => $request->id_beneficiario,
            'id_municipio'      => $request->id_municipio,
            'tipo_cambio'       => 20,//$request->tipo_cambio,
            
            'importe'           => $request->importe,
            'concepto'          => $request->concepto,
            'observaciones'     => $request->observaciones,
            'fecha'             => $request->fecha,
        ]);

        return $ci;
    }

    public function updateCartaInstruccion(Request $request){
        $ci = CartaInstruccion::findOrFail($request->id);
        
        $ci->id_partida         = $request->id_partida;
        $ci->id_beneficiario    = $request->id_beneficiario;
        $ci->id_municipio       = $request->id_municipio;
        $ci->tipo_cambio        = $request->tipo_cambio;
        $ci->importe            = $request->importe;
        $ci->concepto           = $request->concepto;
        $ci->observaciones      = $request->observaciones;
        $ci->fecha              = $request->fecha;

        $ci->save();

        return $ci;
    }

    public function deleteCartaInstruccion(Request $request){
        $id = $request->id;
        $ci = CartaInstruccion::findOrFail($id);
        $ci->delete();

        return $ci;
    }

    public function getAvarageByYear(Request $request){
        $year = $request->year;
        $cartas = CartaInstruccion::whereYear('fecha', $year)->get();
        $sum = $cartas->sum('importe');

        return $sum;
    }

    public function getAllMonthsAverageByYear(Request $request){
        $year = $request->year;

        $cartas = CartaInstruccion::whereYear('fecha', $year)
        ->orderBy('fecha','asc')->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->fecha)->translatedFormat('F');
        });

        $cartaArray=[];
        $cartas->each(function ($carta, $key) use (&$cartaArray){
            $cartaArray[$key]['total'] = $carta->sum('importe');
            $cartaArray[$key]['count'] = count($carta);
            $cartaArray[$key]['items'] = $carta->toArray();
        });

        return $cartaArray;
    }

    public function getAllMunicipuosAvarage(Request $request){
        $year = $request->year;
        $cartaXmunicipio = CartaInstruccion::whereYear('fecha', $year)->with('municipio')->get()
        // ->take(5)
        ->groupBy(function($val) {
            return $val->municipio->name;
        });

        $municipioArray=[];
        $cartaXmunicipio->each(function ($carta, $key) use (&$municipioArray){
            $municipioArray[$key]['total'] = $carta->sum('importe');
            $municipioArray[$key]['count'] = count($carta);
            $municipioArray[$key]['items'] = $carta->toArray();
        });

        return $municipioArray;
    }

    
}
