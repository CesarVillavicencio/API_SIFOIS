<?php

namespace App\Http\Controllers\Test;

use App\Models\User;
use App\Models\CartaInstruccion;
use App\Models\Partida;
use App\Models\Presupuesto;
use App\Models\PresupuestoPartida;
use App\Models\Sepomex\Municipio;
use Carbon\Carbon;
// use DB;


class ChiliTest {

    public static function test(): mixed {
        // ini_set('memory_limit', '-1');
        // ini_set('max_execution_time', 0);
        // nuevo

        $partidas = Partida::All()->toArray();
        dd($partidas);
        $estructuraFinal = [];

        $registros = PresupuestoPartida::with('partida')->where('id_presupuesto', 1)->get();

        foreach ($registros as $registro) {
            $partida = $registro->partida;

            // Carga todos los padres de forma recursiva (sin usar with)
            $jerarquia = $partida->obtenerJerarquiaPadres();
            
            self::agregarPartidaPorJerarquia($estructuraFinal, $jerarquia, $registro->toArray());
        }
        dd($estructuraFinal);
        // 
        // Chatgpt

        $estructuraFinal = [];
        $registros = PresupuestoPartida::with('partida.Allpadres')->where('id_presupuesto', 1)->get();

        foreach ($registros as $registro) {
            $jerarquia = [];
            $partida = $registro['partida'];
            // Extraer jerarquía de padres (más antiguo a más reciente)
            $padre = $partida['allpadres'] ?? null;
            while ($padre && $padre->padre_id) {
                $jerarquia[] = $padre['nombre'];
                $padre = $padre['all_padres'] ?? null;
            }

            $jerarquia = array_reverse($jerarquia); // Para que empiece con el más lejano
            self::agregarPartidaPorJerarquia($estructuraFinal, $jerarquia, $registro->toArray());
        }
        dd($estructuraFinal);

        // ChatGpt

        $items = PresupuestoPartida::with('partida.Allpadres')->where('id_presupuesto', 1)->get();
        dd($items->toArray());
        $finalArray = [];
        foreach ($items as $key => $item) {
            $partida = $item['partida'];       
            $finalArray = self::obtenerPadres($partida, $finalArray);
        }
        dd($finalArray);
        
        return true;
    }

    public static function obtenerPadres($partida, $finalArray){
        $test=[];
        if($finalArray){
            $test = $finalArray;            
        }

        $padres = [];
        $padresJ = [];
        $actual = $partida;
        $i = 0;

        while ($actual->allPadres) {
            if($i > 0){
                $padresJ[$actual->nombre] = $padres;
            }
            
            $padres=[];
            $padres[] = $actual->nombre;
            
            $actual = $actual->allPadres;
            $actual->allPadres ? : $finalArray[$actual->nombre] = $padresJ;
            $i++;
            
        }

        $finalArray = self::mergeArreglosProfundamente($finalArray, $test);
        return $finalArray;
    }

    public static function mergeArreglosProfundamente($array1, $array2) {
        foreach ($array2 as $key => $value) {
            if (isset($array1[$key]) && is_array($value)) {
                $array1[$key] = self::mergeArreglosProfundamente($array1[$key], $value);
            } else {
                $array1[$key] = $value;
            }
        }
        return $array1;
    }

    // BIEN FALTA EL ULTIMO PADRE
    public static function agregarPartidaPorJerarquia(&$estructura, $jerarquia, $elemento) {
        $nivel = &$estructura;

        foreach ($jerarquia as $nivelNombre) {
            if (!isset($nivel[$nivelNombre])) {
                $nivel[$nivelNombre] = [];
            }
            $nivel = &$nivel[$nivelNombre]; // Navega al siguiente nivel
        }

        $nivel[] = $elemento; // 
    }

    //NEW
    public static function obtenerJerarquiaPadres()
    {
        $jerarquia = [];
        $actual = $this;

        while ($actual->padres) {
            $actual = $actual->padres; // Lazy load automáticamente
            $jerarquia[] = $actual->nombre;
        }

        return array_reverse($jerarquia); // Desde el más lejano al inmediato
    }

}
