<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PresupuestoExport;
use App\Exports\ConceptosExport;
use App\Exports\CIExport;
use App\Exports\MultipleSheetExport;
use App\Models\Presupuesto;
use App\Models\Partida;
use App\Models\PresupuestoPartida;
use App\Models\PresupuestoConcepto;
use App\Models\Sepomex\Municipio;
use App\Models\PresupuestoCI;
use App\Models\Bitacora;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;

class PresupuestosController extends Controller
{
    public function getFideicomisos(){
        $fideicomisos = DB::table('fideicomisos')->get();
        return $fideicomisos;
    }

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
                    'presupuestado' => 0,
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

            // Inicializar lista de procesados para NO repetir partidas
            if (!isset($padre['procesados'])) {
                $padre['procesados'] = [];
            }

            $idPartida = $elemento['id_partida'];
            $presupuestadoNuevo = $elemento['presupuestadoEnPartida'] ?? 0;

            // Solo sumar si no se ha contado esta partida antes
            if (!in_array($idPartida, $padre['procesados'])) {
                $padre['presupuestado'] += $presupuestadoNuevo;
                $padre['procesados'][] = $idPartida;
            }
        
        }
    }

    public function getAll(Request $request){
        $id = $request->id;

        $query = Presupuesto::query();
        $query->where('id_fideicomiso', $id);

        $query->when($request->busqueda != null, function($b) use ($request){
            // PostgreSQL's LIKE operator is case-sensitive by default. To perform a case-insensitive search, use the ILIKE operator.
            $b->where('serie', 'ILIKE', '%'.$request->busqueda .'%');
        });

        $presupuestos = $query->orderBy('id','desc')->paginate(20);

        return $presupuestos;
    }

    public function getPresupuesto(Presupuesto $presupuesto){
        return $presupuesto;
    }

    public function createPresupuesto(Request $request){
        $ids=[];
        //return $request->id_municipio;
        foreach ($request->id_municipio as $key => $municipio) {
            $ids[] = $municipio;
        }

        $presupuesto = Presupuesto::create([
            'id_fideicomiso'=> $request->id_fideicomiso,
            'serie'         => $request->serie,
            'periodo'       => $request->periodo ?? '2021-2027',
            'estatus'       => 'aprobado',
            'year'          => $request->year ?? Carbon::now()->year,
            'id_municipio'  => $ids,
            'creado_por'    => $request->creado_por,
            'tipo_cambio'   => $request->tipo_cambio,
            'valor_cambio'  => $request->valor_cambio,
            'fecha'         => $request->fecha_creacion
        ]);

        // Bitacora
        $bitacora = new Bitacora();
        $bitacora->usuario = $request->creado_por;
        $bitacora->descripcion = 'Se Agrego el presupuesto con id: ' .$presupuesto->id;
        $presupuesto->bitacora()->save($bitacora);
        return $presupuesto;

        return $presupuesto;
    }

    public function toggleEstatus(Request $request){
        $id = $request->id;
        $presupuesto = Presupuesto::findOrFail($id);
        $oldEstatus = $presupuesto->estatus;
        $presupuesto->estatus = $request->estatus;
        $presupuesto->save();

        // Bitacora
        $bitacora = new Bitacora();
        $bitacora->usuario = $request->creado_por;
        $bitacora->descripcion = 'Se cambio el estatus de '.$oldEstatus.' a '.$request->estatus;
        $presupuesto->bitacora()->save($bitacora);
        return $presupuesto;
    }

    public function updatePresupuesto(Request $request){
        $presupuesto = Presupuesto::findOrFail($request->id);
        $originalValues = $presupuesto->getOriginal();

        $presupuesto->update([
            'serie'         => $request->serie,
            'periodo'       => $request->periodo,
            'year'          => $request->year,
            'id_municipio'  => $request->id_municipio
        ]);

        // Bitacora

        // Obtener los nuevos valores que cambiaron
        $newValues = $presupuesto->getChanges();

        $changes = [];
        foreach ($newValues as $key => $newValue) {
            if ($key === 'updated_at') continue;
            $changes[$key] = [
                'valor_anterior' => $originalValues[$key] ?? null,
                'valor_nuevo' => $newValue,
            ];
        }

        $bitacora = new Bitacora();
        $bitacora->usuario = $request->creado_por;
        $bitacora->descripcion = 'Se actualizó el presupuesto con los siguientes cambios: ' . json_encode($changes);
        $presupuesto->bitacora()->save($bitacora); 

        return $presupuesto;

    }

    public function deletePresupuesto(Request $request){
        $presupuesto = Presupuesto::findOrFail($request->id);
        $presupuesto->delete();

        $bitacora = new Bitacora();
        $bitacora->usuario = $request->eliminado_por;
        $bitacora->descripcion = 'se elimino el presupuesto con el id: ' .$presupuesto->id;
        $presupuesto->bitacora()->save($bitacora); 

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
        if($request->addToCI){
            $exist = PresupuestoCI::where('id_presupuesto', $request->id_presupuesto)
                    ->where('id_partida', $request->id_partida)
                    ->exists();
            if (!$exist) {return;}

            $year = Carbon::parse($request->fecha ?? now() )->format('Y');
            $latest  = PresupuestoCI::withTrashed()->latest('ci')->whereYear('fecha', $year)->select('ci')->first();
        
            $ci_id = $latest ?  $latest->ci + 1 : 1;

             PresupuestoCI::create([
                'id_presupuesto'    => $request->id_presupuesto,
                'id_partida'        => $request->id_partida,
                'ci'                => $ci_id,
                'id_municipio'      => $pp->presu->id_municipio,
                'presupuestado'     => 0,
                'importe'           => 0,
                'importe_meses'     => $this->getMonthsValue(),
                'concepto'          => 'concepto',
                'creado_por'        => $request->creado_por,
                'fecha'             => now(),
            ]);
        }
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

        $registros = PresupuestoCI::with('partida', 'beneficiario')->where('id_presupuesto', $request->id)->orderBy('id','DESC')->get();
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
        $pci = PresupuestoCI::with('partida')->findOrFail($request->id);
        $oldValues = $pci->importe_meses;

        // Calcular nuevo importe total del registro actual
        $importe = 0;
        foreach ($request->importe_meses as $value) {
            $importe += $value['importe'];
        }

        // Validar con la función reutilizable
        $validacion = $this->validarImporte(
            $request->id_presupuesto,
            $request->id_partida,
            $importe,
            $request->id // excluye el registro actual
        );

        if(!$validacion['valid']){
            abort(404, $validacion['mensaje']);
        }

        $pci->update($request->only(['importe_meses']));
        $pci->importe = $importe;
        $pci->save();

        // Bitacora
        $cambios = [];
        foreach ($oldValues as $key => $item) {
            $importeActualizado = $pci->importe_meses[$key]['importe'];

            if ($item['importe'] !== $importeActualizado) {
                $cambios[] = [
                    'mes'               => $item['mes'],
                    'importe_anterior'  => $item['importe'],
                    'importe_nuevo'     => $importeActualizado,
                ];
            }
        }

        $bitacora = new Bitacora();
        $bitacora->usuario = $request->actualizado_por;
        $bitacora->descripcion = 'Se han modificado los meses: ' . json_encode($cambios);
        $pci->presu->bitacora()->save($bitacora);

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
        if( $request->importe <= 0) {
            abort(404, 'No acepta Numeros menores o iguales a cero');
        }
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

    //PRESUPUESTO CARTA INSTRUCCION

    /**
     * Crea un nuevo PresupuestoCI con opción de asignar un importe inicial en un mes específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\PresupuestoCI
     */
    public function createPresupuestoCI(Request $request){
        $importe = $request->ingreso_mes ?? 0;

        if($importe > 0){
            $validacion = $this->validarImporte($request->id_presupuesto, $request->id_partida,$importe
                // sin exclude_id porque el registro aún no existe
            );

            if(!$validacion['valid']){
                abort(404, $validacion['mensaje']);
            }
        }
        
        $year = Carbon::parse($request->fecha)->format('Y');
        $latest  = PresupuestoCI::withTrashed()->latest('ci')->whereYear('fecha', $year)->select('ci')->first();
        
        $ci_id = $latest ?  $latest->ci + 1 : 1;
        
        $pci = PresupuestoCI::create([
            'id_presupuesto'    => $request->id_presupuesto,
            'id_partida'        => $request->id_partida,
            'ci'                => $ci_id,
            'id_beneficiario'   => $request->id_beneficiario,
            'id_municipio'      => $request->id_municipio,
            'presupuestado'     => 0,
            'importe'           => $importe,
            'importe_meses'     => $this->getMonthsValue($request->mes, $importe),
            'concepto'          => $request->concepto,
            'observaciones'     => $request->observaciones,
            'fecha'             => $request->fecha,
            'creado_por'        => $request->creado_por,
            'actualizado_por'   => $request->actualizado_por,
        ]);

        // Bitacora
        $bitacora = new Bitacora();
        $bitacora->usuario = $request->creado_por;
        $bitacora->descripcion = 
        'Se agrego el CI con la partida '.$pci->partida->nombre .', y beneficiario '.( $pci->beneficiario?->nombre ?? 'SIN BENEFICIARIO');

        if($importe > 0){
            $bitacora->descripcion .= '. Importe inicial de ' . Number::currency($importe) . ' en el mes de ' . $request->mes;
        }
        $pci->presu->bitacora()->save($bitacora);

    }

    public function updatePresupuestoCI(Request $request){
        $ci = PresupuestoCI::findOrFail($request->id);
        
        $ci->id_beneficiario = $request->id_beneficiario;
        $ci->id_partida = $request->id_partida;
        $ci->fecha = $request->fecha;
        $ci->concepto = $request->concepto;
        $ci->observaciones = $request->observaciones;
        $ci->save();
        return $ci;

    }

    public function deletePresupuestoCI(Request $request){
        $id = $request->id;
        $presupuestoCI = PresupuestoCI::findOrFail($id);
        $presupuestoCI->delete();
        return $presupuestoCI;
    }

    public static function getMonthsValue($mesSeleccionado = null, $importe = 0){
        $meses =  [
            ['mes'=>'enero', 'importe'=> "0.00"],
            ['mes'=>'febrero', 'importe'=> "0.00"],
            ['mes'=>'marzo', 'importe'=> "0.00"],
            ['mes'=>'abril', 'importe'=> "0.00"],
            ['mes'=>'mayo', 'importe'=> "0.00"],
            ['mes'=>'junio', 'importe'=> "0.00"],
            ['mes'=>'julio', 'importe'=> "0.00"],
            ['mes'=>'agosto', 'importe'=> "0.00"],
            ['mes'=>'septiembre', 'importe'=> "0.00"],
            ['mes'=>'octubre', 'importe'=> "0.00"],
            ['mes'=>'noviembre', 'importe'=> "0.00"],
            ['mes'=>'diciembre', 'importe'=> "0.00"],
        ];

        if ($mesSeleccionado) {
            foreach ($meses as &$mes) {
                if ($mes['mes'] === strtolower($mesSeleccionado)) {
                    $mes['importe'] = number_format($importe, 2, '.', '');
                    break;
                }
            }
        }

        return $meses;
    }

    //Funciones Clonar
    public function cloneCI(Request $request){
        $ci_id = $request->id;
        $ci_a_clonar = PresupuestoCI::with('presu')->findOrFail($ci_id);
        $presu = $ci_a_clonar->presu;

        $fecha = Carbon::parse($presu->fecha)->format('Y');
        $year = Carbon::parse($fecha)->format('Y');
        //$cartas = PresupuestoCI::withTrashed()->whereYear('fecha', $year)->get();
        //$ci_id = count($cartas) + 1;

        $latest  = PresupuestoCI::withTrashed()->latest('ci')->whereYear('fecha', $year)->select('ci')->first();
        $ci_id = $latest ? $latest->ci + 1 : 1;
        
        $pci = PresupuestoCI::create([
            'id_presupuesto'    => $ci_a_clonar->id_presupuesto,
            'id_partida'        => $ci_a_clonar->id_partida,
            'ci'                => $ci_id,
            'id_beneficiario'   => $ci_a_clonar->id_beneficiario,
            'id_municipio'      => $ci_a_clonar->id_municipio,
            'presupuestado'     => 0,
            'importe'           => 0,
            'importe_meses'     => $this->getMonthsValue(),
            'concepto'          => 'concepto',
            // 'observaciones'     => $request->observaciones,
            'fecha'             => $presu->fecha,
            'creado_por'        => $request->creado_por,
            // 'actualizado_por'   => $request->actualizado_por,
        ]);

        // Bitacora
        $bitacora = new Bitacora();
        $bitacora->usuario = $request->creado_por;
        $bitacora->descripcion = 
        'Se agrego el CI con la partida '.$pci->partida->nombre .', y beneficiario '. ($pci->beneficiario->nombre ?? 'sin Beneficiario') .' (clon)';
        
        $pci->presu->bitacora()->save($bitacora);
        
        return $pci;
        
    }

    public function getExcelCI(Request $request){
        $id_presupuesto = $request->id;
        // $presupuestoCI = PresupuestoCI::with('beneficiario','presu','partida')->where('id_presupuesto',$id_presupuesto)->get();

        $registros = PresupuestoCI::with('partida', 'beneficiario')->where('id_presupuesto', $id_presupuesto)->get();
      
        $estructuraFinal=[];
        foreach ($registros as $registro) {

            $partida = $registro->partida;
            // Carga todos los padres de forma recursiva
            $jerarquia = $partida->obtenerJerarquiaPadres();

            $this->agregarPartidaPorJerarquia($estructuraFinal, $jerarquia, $registro->toArray());
        }

        $data=[];
        $this->recorrerJerarquia($estructuraFinal, 3, $data);

        return Excel::download(new CIExport($estructuraFinal), 'CartasInstruccion.xlsx');
    }
    public function getMultipleExcel(Request $request){
        // return $request;
        return Excel::download(new MultipleSheetExport($request->id), 'MultipleSheet.xlsx');
    }

    //Reportes
    public function getDataForPresupuestoReportes(Request $request){    
        $data_beneficiarios = [];
        $data_partida = [];
        $data_dona = [];
        $total = 0;

        //get CIS del presupuesto
        $CIS =  PresupuestoCi::with('beneficiario','partida','presu')->where('id_presupuesto', $request->id)->get();

        // Data para beneficiarios
        $beneficiarios = $CIS->groupBy(function($val) {
            return $val->beneficiario->fullName ?? 'Sin Beneficiario';
        });

        $beneficiarios->each(function ($beneficiario, $key) use (&$labels, &$data_beneficiarios){
            
            $data_beneficiarios[] = [
                'label'=> $key, 
                'backgroundColor' => sprintf("#%02x%02x%02x", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255)), 
                'data'=> [$beneficiario->sum('importe')]
            ];
        });

        // Data para Partidas
        $data_partidas = $CIS->groupBy(function($val) {
            return $val->partida->nombre;
        });

        $data_partidas->each(function ($partida, $key) use (&$data_partida){
            
            $data_partida[] = [
                'label'=> $key, 
                'backgroundColor' => sprintf("#%02x%02x%02x", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255)), 
                'data'=> [$partida->sum('importe')]
            ];
        });

        // PieChart data
        $total = 0;
        $labels = [];
        $background = [];
        $data = [];

        $data_partidas->each(function ($partida, $key) use (&$background, &$data, &$labels, &$loop, &$total){
           
            $labels[] = $key;
            $background[]= sprintf("#%02x%02x%02x", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            $data[] = $partida->sum('importe');
            $total = ($partida[0]->presu->getPresupuesto() - $partida[0]->presu->getEjercido());
             
        });
        $labels[] = 'Por Ejercer';
        $background[] = sprintf("#%02x%02x%02x", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        $data[] = $total;

        $data_dona[] = [
            'label'=> $labels, 
            'backgroundColor' => $background, 
            'data'=> $data
        ];

        return ['data_partidas' => $data_partida, 'data_beneficiarios' => $data_beneficiarios, 'data_dona' => $data_dona];
    }   


    /**
     * Valida que el importe no exceda los límites del presupuesto general y por partida.
     *
     * @param int        $id_presupuesto  ID del presupuesto a validar
     * @param int        $id_partida      ID de la partida a validar
     * @param float      $importe         Importe a validar
     * @param int|null   $exclude_id      ID del PresupuestoCI a excluir (usar en updates)
     *
     * @return array{valid: bool, mensaje: string|null}
     */
    private function validarImporte(int $id_presupuesto, int $id_partida, float $importe, ?int $exclude_id = null): array 
    {
        // Negativo
        if($importe < 0){
            return [
                'valid' => false,
                'mensaje' => 'No acepta numeros negativos.'
            ];
        }

        $presupuesto = Presupuesto::findOrFail($id_presupuesto);

        // Suma de otros CIs del mismo presupuesto
        $sumaDeOtrosCI = 0;
        PresupuestoCI::where('id_presupuesto', $id_presupuesto)
            ->when($exclude_id, fn($q) => $q->where('id', '!=', $exclude_id))
            ->get()
            ->each(function($pci_) use (&$sumaDeOtrosCI) {
                foreach ($pci_->importe_meses as $value) {
                    $sumaDeOtrosCI += $value['importe'];
                }
            });

        // Checar límite general
        if((float)($sumaDeOtrosCI + $importe) > (float) $presupuesto->presupuestado){
            $disponibleReal = $presupuesto->presupuestado - $sumaDeOtrosCI;
            return [
                'valid' => false,
                'mensaje' => 'Excede el importe general del presupuesto.'
                    . '<br> Disponible: '        . Number::currency($disponibleReal)
                    . '<br> Importe ingresado: ' . Number::currency($importe)
            ];
        }

        // Buscar el presupuesto de la partida en presupuesto_partidas
        $presupuestoPartida = PresupuestoPartida::where('id_presupuesto', $id_presupuesto)
            ->where('id_partida', $id_partida)
            ->firstOrFail();

        // Suma de otros CIs de la misma partida
        $sumaDeOtrosCIXPartida = 0;
        PresupuestoCI::where('id_presupuesto', $id_presupuesto)
            ->where('id_partida', $id_partida)
            ->when($exclude_id, fn($q) => $q->where('id', '!=', $exclude_id))
            ->get()
            ->each(function($pci_) use (&$sumaDeOtrosCIXPartida) {
                foreach ($pci_->importe_meses as $value) {
                    $sumaDeOtrosCIXPartida += $value['importe'];
                }
            });

        if((float)($importe + $sumaDeOtrosCIXPartida) > (float) $presupuestoPartida->presupuesto){
            $partida = Partida::findOrFail($id_partida);
            return [
                'valid' => false,
                'mensaje' => 'Excede el importe presupuestado en la partida ' . $partida->nombre . '.'
                    . '<br> Presupuestado: '     . Number::currency($presupuestoPartida->presupuesto)
                    . '<br> Ocupado por otros: ' . Number::currency($sumaDeOtrosCIXPartida)
                    . '<br> Tu importe: '        . Number::currency($importe)
            ];
        }

        return ['valid' => true, 'mensaje' => null];
    }
};
