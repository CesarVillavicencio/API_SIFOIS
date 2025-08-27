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
        $registros = PresupuestoCI::with('partida', 'beneficiario')->where('id_presupuesto', 1)->get();
        // $registros = PresupuestoPartida::with('partida')->where('id_presupuesto', 1)->get();
        $estructuraFinal=[];
        foreach ($registros as $registro) {

            $partida = $registro->partida;
            // Carga todos los padres de forma recursiva
            $jerarquia = $partida->obtenerJerarquiaPadres();

            self::agregarPartidaPorJerarquia($estructuraFinal, $jerarquia, $registro->toArray());
        }

        $data=[];
        self::recorrerJerarquia($estructuraFinal, 3, $data);
        return $estructuraFinal;
        
        
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
            dd($padre);
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
