<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\PresupuestoExport;
use App\Exports\CIExport;
use App\Models\PresupuestoCI;
use App\Models\PresupuestoConcepto;
use App\Models\PresupuestoPartida;
use App\Models\Sepomex\Municipio;
use App\Models\Presupuesto;

class MultipleSheetExport implements WithMultipleSheets
{
    use Exportable;

    protected $id;
    
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $id = $this->id;
        // Get data for conceptos
        $conceptos = $this->getConceptos($id);
        // Get data for presupuestos;
        $presupuesto = $this->getPresupuestosData($id);
        // get Data for CIS;
        $cis = $this->getCISData($id);

        $sheets = [];
        $sheets[] = new ConceptosExport($conceptos);
        $sheets[] = new CIExport($cis);
        $sheets[] = new PresupuestoExport($presupuesto['estructura_final'], $presupuesto['municipios_names']);
        
        return $sheets;
    }

    public function getConceptos($id){
        $data = PresupuestoConcepto::where('id_presupuesto', $id)->get()->toArray();
        return $data;
    }
    public function getPresupuestosData($id){
        $presupuesto = Presupuesto::findOrFail($id);       
        $registros = PresupuestoPartida::with('partida')->where('id_presupuesto', $id)->get();

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

        return ['estructura_final' => $estructuraFinal, 'municipios_names' => $municipios_names];
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

    public function getCISData($id_presupuesto){
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
}