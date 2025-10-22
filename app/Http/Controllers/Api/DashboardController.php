<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beneficiario;
use App\Models\CartaInstruccion;
use App\Models\Partida;
use App\Models\Presupuesto;
use App\Models\PresupuestoCI;
use App\Models\UserRights;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getChartData(Request $request){
        $labels = [];
        $data = [];

        $year = $request->year;
        $months = [
        0 => 'enero', 1 => 'febrero', 2 => 'marzo', 3 => 'abril', 4 => 'mayo', 5 => 'junio', 6 => 'julio', 7 => 'agosto',  8 => 'septiembre',  9 => 'octubre', 10 => 'noviembre', 11 => 'diciembre'
        ];

        $cartas = PresupuestoCI::whereYear('fecha', $year)
        ->orderBy('fecha','asc')->get();

        for ($i = 0; $i <= 11; $i++) {
            $labels[] = $months[$i];
            $data[] = $cartas->sum(function ($item) use ($i) {
                return $item['importe_meses'][$i]['importe'];
            });
        }

        return ['labels' => $labels, 'data' => $data];
    }

    public function getChartMunicipios(Request $request){
        // $labels = [];
        // $data = [];

        // $year = $request->year;

        // $cartas = Presupuesto::with('municipio')->whereYear('fecha', $year)
        // ->orderBy('fecha','asc')->get()
        // ->groupBy(function($val) {
        //     return $val->municipio->name ?? 'nohay';
        // });

        // $cartas->each(function ($carta, $key) use (&$labels, &$data){
        //     // $cartaArray[$key]['total'] = $carta->sum('importe');
        //     // $cartaArray[$key]['count'] = count($carta);
        //     // $cartaArray[$key]['items'] = $carta->toArray();
        //     $labels[] = $key;
        //     $data[] = $carta->sum('importe'); 
        // });

        // // return $cartaArray;
        // return ['labels' => $labels, 'data' => $data];

        $labels = [];
        $data = [];

        $year = $request->year;

        //created at x fecha
        $cartas = Presupuesto::whereYear('created_at', $year)
        ->orderBy('created_at','asc')->get()
        ->groupBy(function($val) {
            return $this->getStringOfMunicipiosArray($val->id_municipio);
        });

        $cartas->each(function ($carta, $key) use (&$labels, &$data){

            $labels[] = $key;
            $data[] = $carta[0]->getEjercido(); 
        });

        return ['labels' => $labels, 'data' => $data];
    }

    public function getStringOfMunicipiosArray($array){

        $municipios = [
            17 => 'Comondú',
            18 => 'Mulegé',
            19 => 'La Paz',
            20 => 'Los Cabos',
            21 => 'Loreto',
        ];

        $string = '';
        if(count($array) == 1){ return $municipios[$array[0]]; }

        sort($array);
        foreach ($array as $key => $municipio) {
            $string .= (count($array) -1) == $key ? $municipios[$municipio]: $municipios[$municipio].'-';
           
        }

        return $string;

    }

    public function getChartYearMonths(){
        // $data = [];

        // $cartas = PresupuestoCI::get()->groupBy(function($val) {
        //     return Carbon::parse($val->fecha)->format('Y');
        // });

        // $cartas->each(function ($carta, $key) use (&$data){
        //     $meses = $carta->groupBy(function($val) {
        //         return  Carbon::parse($val->fecha)->format('m');
        //         // return Carbon::parse($val->fecha)->translatedFormat('F');
        //     });

        //     $meses_ordered = $meses->sortKeys();
        //     $meses_ordered->each(function ($mes, $key_2) use (&$data, $key){
        //         $data[$key]['labels'][] = $key_2;
        //         $data[$key]['data'][] = $mes->sum('importe');
        //     });
            
        // });

        $data = [];

        $cartas = PresupuestoCI::get()->groupBy(function($val) {
            return Carbon::parse($val->fecha)->format('Y');
        });

        $cartas->each(function ($carta, $key) use (&$data){   
            for ($i = 0; $i <= 11; $i++) {
                $data[$key]['labels'][] = $i;

                $data[$key]['data'][] = $carta->sum(function ($item) use ($i) {
                        return $item['importe_meses'][$i]['importe'];
                    });
            }           
            
        });
        
        return $data;
    }

    public function getTopBeneficiarios(){
        $topBeneficiarios = PresupuestoCI::with('beneficiario')->select('id_beneficiario')
            ->selectRaw('count(id_beneficiario) as qty')
            ->groupBy('id_beneficiario')
            ->orderBy('qty', 'DESC')
            ->get()->take(10);

        $data = [];
        $topBeneficiarios->each(function ($item, int $key) use(&$data) {
            //dd($item);
            $array['beneficiario'] = $item->beneficiario->nombre .' '.$item->beneficiario->apellido;
            $array['total_cartas'] = $item->qty;
            $array['total_importe'] = $this->getTotal($item->id_beneficiario);
            $data[] = $array;
        });
        
        return $data;
    }
    
    public function getTotal($id){
        $data = PresupuestoCI::where('id_beneficiario', $id)->get();
        return $data->sum('importe');
    }
}
