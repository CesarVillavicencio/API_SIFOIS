<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PresupuestoExport;
use App\Models\Presupuesto;
use App\Models\PresupuestoPartida;
use App\Models\Sepomex\Municipio;

class PresupuestosController extends Controller
{
    public function getExcel(Request $request){
        $presupuesto = Presupuesto::findOrFail($request->id);       
        $registros = PresupuestoPartida::with('partida')->where('id_presupuesto', $request->id)->get();

        $estructuraFinal=[];
        foreach ($registros as $registro) {
            $partida = $registro->partida;
            // Carga todos los padres de forma recursiva
            $jerarquia = $partida->obtenerJerarquiaPadres();
            $this->agregarPartidaPorJerarquia($estructuraFinal, $jerarquia, $registro->toArray());
        }
        $municipios = Municipio::whereIn('id', $presupuesto->id_municipio)->get();

        $length = $municipios->count();
        $municipios_names = '';
        foreach ($municipios as $key => $value ) {
            $municipios_names .= $value->name .( ($key + 1) == $length ? '' : ' - '); 
        };
        // return $estructuraFinal;
        return Excel::download(new PresupuestoExport($estructuraFinal, $municipios_names), 'presupuesto.xlsx');
    }

    public function agregarPartidaPorJerarquia(&$estructura, $jerarquia, $elemento) {

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
        // Ahora actualizamos el presupuesto de cada padre sumando el presupuesto del nuevo elemento
        $presupuestoNuevo = $elemento['presupuesto'] ?? 0;
        foreach ($padres_referencias as &$padre) {
            // Sumamos el presupuesto nuevo al presupuesto actual del padre
            $padre['presupuesto'] += $presupuestoNuevo;
        }
    }

    public function createPresupuesto(){
        
    }

    public function updatePresupuesto(){

    }

    public function deletePresupuesto(){
        
    }
}
