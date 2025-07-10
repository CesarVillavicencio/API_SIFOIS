<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beneficiario;
use App\Models\CartaInstruccion;
use App\Models\Partida;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getChartData(Request $request){
        $labels = [];
        $data = [];

        $year = $request->year;

        $cartas = CartaInstruccion::whereYear('fecha', $year)
        ->orderBy('fecha','asc')->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->fecha)->translatedFormat('F');
        });

        // $cartaArray=[];
        $cartas->each(function ($carta, $key) use (&$labels, &$data){
            // $cartaArray[$key]['total'] = $carta->sum('importe');
            // $cartaArray[$key]['count'] = count($carta);
            // $cartaArray[$key]['items'] = $carta->toArray();
            $labels[] = $key;
            $data[] = $carta->sum('importe'); 
        });

        // return $cartaArray;
        return ['labels' => $labels, 'data' => $data];
    }

    public function getChartMunicipios(Request $request){
        $labels = [];
        $data = [];

        $year = $request->year;

        $cartas = CartaInstruccion::with('municipio')->whereYear('fecha', $year)
        ->orderBy('fecha','asc')->get()
        ->groupBy(function($val) {
             return $val->municipio->name;
        });

        // $cartaArray=[];
        $cartas->each(function ($carta, $key) use (&$labels, &$data){
            // $cartaArray[$key]['total'] = $carta->sum('importe');
            // $cartaArray[$key]['count'] = count($carta);
            // $cartaArray[$key]['items'] = $carta->toArray();
            $labels[] = $key;
            $data[] = $carta->sum('importe'); 
        });

        // return $cartaArray;
        return ['labels' => $labels, 'data' => $data];
    }

    public function getChartYearMonths(){
        $data = [];

        $cartas = CartaInstruccion::get()->groupBy(function($val) {
            return Carbon::parse($val->fecha)->format('Y');
        });

       return $cartas;

        $cartas->each(function ($carta, $key) use (&$data){
            $meses = $carta->groupBy(function($val) {
                return  Carbon::parse($val->fecha)->format('m');
                // return Carbon::parse($val->fecha)->translatedFormat('F');
            });
            $meses_ordered = $meses->sortKeys();
            $meses_ordered->each(function ($mes, $key_2) use (&$data, $key){
                $data[$key]['labels'][] = $key_2;
                $data[$key]['data'][] = $mes->sum('importe');
            });
            
        });
        
        return response()->json($data);//$data;
    }

    public function getTopBeneficiarios(){
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
            $array['total_importe'] = this->getTotal($item->id_beneficiario);
            $data[] = $array;
         });
    }
    public function getTotal($id){
        $data = CartaInstruccion::where('id_beneficiario', $id)->get();
        return $data->sum('importe');
    }
}
