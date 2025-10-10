<?php

namespace App\Http\Controllers\Test;

use App\Models\User;
use App\Models\CartaInstruccion;
use App\Models\Partida;
use App\Models\Presupuesto;
use App\Models\Beneficiario;
use App\Models\PresupuestoPartida;
use App\Models\Bitacora;
use App\Models\PresupuestoCi;
use App\Models\Sepomex\Municipio;
use Carbon\Carbon;
// use DB;


class ChiliTest {

    public static function test(): mixed {
        $data_dona['label']=[];
        $total = 0;
        $labels = [];
        $background = [];
        $data = [];
       
        $CIS =  PresupuestoCi::with('beneficiario','partida','presu')->where('id_presupuesto', 2)->get();
        
        $data_partidas = $CIS->groupBy(function($val) {
            return $val->partida->nombre;
        });

        $loop = 0;
        $data_partidas->each(function ($partida, $key) use (&$background, &$data, &$labels, &$loop, &$total){
            $text = $loop == 0 ? '':', ';

            $labels[] = $key;
            $background[] = sprintf("#%02x%02x%02x", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            $data[] = $partida->sum('importe');
            $total = $partida[0]->presu->getPresupuesto();
            $loop++;
             
        });
        $data_array[] = [
            'label'=> json_encode($labels), 
            'backgroundColor' => json_encode($background), 
            'data'=> json_encode($data), 
        ];
       
        dd($labels);
        return 'X';

        
    }

    public static function agregarPartidaPorJerarquia(&$estructura, $jerarquia, $elemento) {

        $ref = &$estructura;
        // Guardaremos referencias a cada nodo padre para luego actualizar presupuesto
        $padres_referencias = [];

        foreach ($jerarquia as $padre) {
            $nombre = is_array($padre) ? ($padre['nombre'] ?? null) : $padre;

            // Inicializar el nodo padre si no existe o no está bien formado
            if (!isset($ref[$nombre]) || !is_array($ref[$nombre])) {
                $ref[$nombre] = [
                    'nombre' => $nombre,
                    'presupuesto' => 0,
                    'children' => [],
                ];
            }
            // Guardamos referencia al nodo padre actual para actualizar presupuesto luego
            $padres_referencias[] = &$ref[$nombre];
            $ref = &$ref[$nombre]['children'];
        }
        // Agregamos la partida final (elemento)
        $ref[] = $elemento;
        // dd($elemento);
        // Ahora actualizamos el presupuesto de cada padre sumando el presupuesto del nuevo elemento
        $presupuestoNuevo = $elemento['importe'] ?? 0;
        foreach ($padres_referencias as &$padre) {
            // Sumamos el presupuesto nuevo al presupuesto actual del padre
            $padre['presupuesto'] += $presupuestoNuevo;
            // dd($padre);
        }
        
        
    }

    public static function recorrerJerarquia($estructura, $nivel, &$rows)
    {
        foreach ($estructura as $nodo) {
            $nombre = $nodo['nombre'] ?? $nodo['partida']['nombre'];
            $presupuesto = $nodo['presupuesto'] ?? ($nodo['presupuesto_total'] ?? '');

            $rows[] = [$nombre, $presupuesto];

            // Guardamos la fila actual (última añadida) y nivel
            $filaActual = count($rows);
            $filasConNivel[$filaActual] = $nivel;

            if (isset($nodo['children']) && is_array($nodo['children'])) {
                self::recorrerJerarquia($nodo['children'], $nivel + 1, $rows);
            }
        }
    }

    
}
