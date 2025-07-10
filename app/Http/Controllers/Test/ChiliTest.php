<?php

namespace App\Http\Controllers\Test;

use App\Models\User;
use App\Models\CartaInstruccion;
use App\Models\Partida;
use Carbon\Carbon;
// use DB;


class ChiliTest {

    public static function test(): mixed {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        $topBeneficiarios = CartaInstruccion::with('beneficiario')->select('id_beneficiario')
            ->selectRaw('count(id_beneficiario) as qty')
            ->groupBy('id_beneficiario')
            ->orderBy('qty', 'DESC')
            ->get()->take(10);

        $data = [];
        $topBeneficiarios->each(function ($item, int $key) use(&$data) {
            //dd($item);
            $array['beneficiario'] = $item->beneficiario->nombre .' '.$item->beneficiario->apellido;
            $array['total_cartas'] = $item->qty;
            $array['total_importe'] = self::getTotal($item->id_beneficiario);
            $data[] = $array;
         });
        
         dd($data);
        return true;

        // $cartaArray=[];
        $cartas->each(function ($carta, $key) use (&$labels, &$data){
           
            $labels[] = $key;
            $data[] = $carta->sum('importe'); 
        });

        dd($data);
        // return $cartaArray;
        return ['labels' => $labels, 'data' => $data];

        $partida = Partida::findOrFail(4);
        dd($partida->getAllParents()->reverse());
        $year = 2025;
        $cartaXmunicipio = CartaInstruccion::whereYear('fecha', $year)->with('municipio')->get()
        ->groupBy(function($val) {
            return $val->municipio->name;
        });

        $municipioArray=[];
        $cartaXmunicipio->each(function ($carta, $key) use (&$municipioArray){
            $municipioArray[$key]['total'] = $carta->sum('importe');
            $municipioArray[$key]['count'] = count($carta);
            $municipioArray[$key]['items'] = $carta->toArray();
        });
        
        
        dd($municipioArray);
        $cartas = CartaInstruccion::with('municipio')->whereYear('fecha', '2024')
        ->orderBy('fecha','asc')->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->fecha)->translatedFormat('F');
        });

        $cartaArray=[];

        $cartas->each(function ($carta, $key) use (&$cartaArray) {

            // $cartaArray['TOTAL'] = ($carta->sum('importe'));
            $cartaArray[$key]['total'] = $carta->sum('importe');
            $cartaArray[$key]['count'] = count($carta);
            $cartaArray[$key]['items'] = $carta->toArray();
            // $carta->items = $carta;
            // return $cartaArray;
        });

        dd($cartaArray);

        $fecha = '24-05-2022';
        $año = Carbon::parse($fecha)->format('Y');
        $cartas = CartaInstruccion::withTrashed()
        ->whereYear('fecha', $año)
        ->get();

        $id = count($cartas) + 1;
        dd($id);
        return true;
    }

    public static function getTotal($id){
        $data = CartaInstruccion::where('id_beneficiario', $id)->get();
        return $data->sum('importe');
    }
}
