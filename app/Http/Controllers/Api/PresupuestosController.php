<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PresupuestoExport;
use App\Exports\ConceptosExport;
use App\Exports\MultipleSheetExport;
use App\Models\Presupuesto;
use App\Models\Partida;
use App\Models\PresupuestoPartida;
use App\Models\PresupuestoConcepto;
use App\Models\Sepomex\Municipio;
use App\Models\PresupuestoCI;
use App\Models\Bitacora;
use Carbon\Carbon;

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
        $presupuestoNuevo = $elemento['importe'] ?? 0;
        foreach ($padres_referencias as &$padre) {
            // Sumamos el presupuesto nuevo al presupuesto actual del padre
            $padre['presupuesto'] += $presupuestoNuevo;
        }
        
    }

    public function getAll(){
        $presupuestos = Presupuesto::paginate(20);
        return $presupuestos;
    }

    public function createPresupuesto(Request $request){
        $ids=[];
        foreach ($request->id_municipio as $key => $municipio) {
            $ids[] = $municipio['municipio_id'];
        }

        $presupuesto = Presupuesto::create([
            'periodo'       => $request->periodo ?? '2021-2027',
            'estatus'       => 'aprobado',
            'year'          => $request->year ?? '2025',
            'id_municipio'  => $ids,
            'creado_por'    => $request->creado_por
        ]);

        return $presupuesto;
    }

    public function updatePresupuesto(Request $request){
        $presupuesto = Presupuesto::findOrFail($request->id);
        $presupuesto->update([
            'periodo'       => $request->periodo,
            'year'          => $request->year,
            'id_municipio'  => $request->id_municipio
        ]);
        
        return $presupuesto;

    }

    public function deletePresupuesto(Request $request){
        $presupuesto = Presupuesto::findOrFail($request->id);
        $presupuesto->delete();
        return $presupuesto;
    }

    public function getMovimientos(Request $request){
        $bitacora = Bitacora::where('morphable_type', Presupuesto::class)
        ->where('morphable_id', $request->id)
        ->get();

        return $bitacora;
    }

    // Presupuesto Partida;
    public function getAllPP(Request $request){
        $presupuesto_partida = PresupuestoPartida::with('partida.allPadres')->where('id_presupuesto', $request->id_presupuesto)->get();
        return $presupuesto_partida;
    }

    public function createPP(Request $request){
        $pp = PresupuestoPartida::create([
            'id_presupuesto' => $request->id_presupuesto,
            'id_partida' => $request->id_partida,
            'presupuesto' => $request->presupuesto
        ]);

        // Bitacora
        $partida = Partida::findOrFail($request->id_partida);
        $bitacora = new Bitacora();
        $bitacora->usuario = $request->creado_por;
        $bitacora->descripcion = 'Se agrego al presupuesto('.$request->id_presupuesto.') la partida '. $partida->nombre.'('.$partida->id.'), con presupuesto: '.$request->presupuesto;
        $pp->presu->bitacora()->save($bitacora);

        return $pp;
    }

    public function updatePP(Request $request){
        $pp = PresupuestoPartida::findOrFail($request->id);
        $old_presupuesto = $pp->presupuesto;

        $pp->update([
            'presupuesto' => $request->presupuesto
        ]);

        // Bitacora
        $bitacora = new Bitacora();
        $partida = Partida::findOrFail($request->id_partida);
        $bitacora->usuario = $request->actualizado_por;
        $bitacora->descripcion = 'Se modifico la partida en el presupuesto('.$pp->id_presupuesto.')'. $partida->nombre.' ('.$pp->id.'), de '.$old_presupuesto .' a ' .$request->presupuesto;
        $pp->presu->bitacora()->save($bitacora);

        return $pp;
    }

    public function deletePP(Request $request){
        // Get pp
        $pp = PresupuestoPartida::findOrFail($request->id);
       
        // Bitacora
        $bitacora = new Bitacora();
        $partida = Partida::findOrFail($request->id_partida);
        $bitacora->usuario = $request->actualizado_por;
        $bitacora->descripcion = 
        'Se elimino la partida: '. $partida->nombre.'(id: '.$pp->id .' ),(del presupuesto '.$pp->id_presupuesto.'), con presupuesto de: '.$pp->presupuesto;
        $pp->presu->bitacora()->save($bitacora);

        // Delete pp
        $pp->delete();


        return $pp;
    }

    public function getPresupuestoCI(Request $request){
        // $ci = PresupuestoCI::with('partida', 'beneficiario')->where('id_presupuesto',$request->id)->get();
        // return $ci;

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
        $this->recorrerJerarquia($estructuraFinal, 3, $data);
        return $estructuraFinal;
    }

    public function recorrerJerarquia($estructura, $nivel, &$rows)
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

    public function updateImporteMeses(Request $request){

        $pci = PresupuestoCI::findOrFail($request->id);
        $pci->update($request->all());
        $importe = 0;
        foreach ($pci->importe_meses as $key => $value) {
            $importe += $value['importe'];
        }
        $pci->importe = $importe;
        $pci->save();
        return $pci;
    }

    //Presupuesto CI
    public function getPartidasByPresupuesto(Request $request){
        $id = $request->id;
        $presupuestoPartidas = PresupuestoPartida::where('id_presupuesto', $id)->pluck('id_partida');
        $partidas = Partida::whereIn('id', $presupuestoPartidas)->get();

        return $partidas;
    }

    // Presupuesto concepto
    public function getPresupuestoConceptos(Request $request){
        $id = $request->id;
        $conceptos = PresupuestoConcepto::where('id_presupuesto', $id)->get();

        return $conceptos;       

    }

    public function setPresupuestoConcepto(Request $request){
        $pc = PresupuestoConcepto::Create([
            'id_presupuesto' => $request->id_presupuesto,
            'concepto' => $request->concepto,
            'importe' => $request->importe
        ]);

        return $pc;
    }

    public function updatePresupuestoConcepto(Request $request){
        $pc = PresupuestoConcepto::findOrFail($request->id);
        $pc->update([
            'concepto' => $request->concepto,
            'importe' => $request->importe
        ]);
        return $pc;
    }

    public function deletePresupuestoConcepto(Request $request){
        $pc = PresupuestoConcepto::findOrFail($request->id);
        $pc->delete();
        return $pc;
    }
    public function getExcelConceptos(Request $request){
        $id = $request->id;
        $data = PresupuestoConcepto::where('id_presupuesto', $id)->get()->toArray();

        return Excel::download(new ConceptosExport($data), 'conceptos.xlsx');
    }

    public function createPresupuestoCI(Request $request){
        $exists = PresupuestoCi::where('id_partida', $request->id_partida)
        ->where('id_beneficiario', $request->id_beneficiario)
        ->exists();

        if($exists){
            abort(404, 'Ya existe una CI con ese beneficiario y esa partida.');
        }

        $fecha = Carbon::parse($request->fecha)->format('Y');
        $year = Carbon::parse($fecha)->format('Y');
        $cartas = PresupuestoCI::withTrashed()->whereYear('fecha', $year)->get();
        $ci_id = count($cartas) + 1;
        
        $pci = PresupuestoCI::create([
            'id_presupuesto'    => $request->id_presupuesto,
            'id_partida'        => $request->id_partida,
            'ci'                => $ci_id,
            'id_beneficiario'   => $request->id_beneficiario,
            'id_municipio'      => $request->id_municipio,
            'tipo_cambio'       => 20,//$request->tipo_cambio,
            'presupuestado'     => 0,
            'importe'           => $request->importe ?? 0,
            'importe_meses'     => $this->getMonthsValue(),
            'concepto'          => $request->concepto,
            'observaciones'     => $request->observaciones,
            'fecha'             => $request->fecha,
            'creado_por'        => $request->creado_por,
            'actualizado_por'   => $request->actualizado_por,
        ]);
    }

    public function deletePresupuestoCI(Request $request){
        $id = $request->id;
        $presupuestoCI = PresupuestoCI::findOrFail($id);
        $presupuestoCI->delete();
        return $presupuestoCI;
    }

    public static function getMonthsValue(){
        return [
            ['mes'=>'enero', 'importe'=> 0.00],
            ['mes'=>'febrero', 'importe'=> 0.00],
            ['mes'=>'marzo', 'importe'=> 0.00],
            ['mes'=>'abril', 'importe'=> 0.00],
            ['mes'=>'mayo', 'importe'=> 0.00],
            ['mes'=>'junio', 'importe'=> 0.00],
            ['mes'=>'julio', 'importe'=> 0.00],
            ['mes'=>'agosto', 'importe'=> 0.00],
            ['mes'=>'septiembre', 'importe'=> 0.00],
            ['mes'=>'octubre', 'importe'=> 0.00],
            ['mes'=>'noviembre', 'importe'=> 0.00],
            ['mes'=>'diciembre', 'importe'=> 0.00],
        ];
    }

    public function getMultipleExcel(){
        return Excel::download(new MultipleSheetExport(), 'MultipleSheet.xlsx');
    }
};
