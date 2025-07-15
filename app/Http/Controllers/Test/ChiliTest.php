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
    }

    public static function getTotal($id){
        $data = CartaInstruccion::where('id_beneficiario', $id)->get();
        return $data->sum('importe');
    }
}
