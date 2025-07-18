<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PresupuestoExport implements FromArray, WithEvents, ShouldAutoSize
{   

    protected $data;
    protected $municipios_name;
    
    public function __construct(array $data, string $municipios_name)
    {
        // dd($beneficiarios);
        $this->data = $data;
        $this->municipios_name = $municipios_name;
    }

    // /**
    // * @return \Illuminate\Support\Collection
    // */

    // public function collection()
    // {
    //      return $this->reservas;
    // }

    

    // public function headings(): array
    // {
    //      return array_keys($this->data[0]); // Encabezados a partir del primer elemento
        
    // }

    public function array():array
    {
        $rows = [];
        $rows[0] = [' '];
        $rows[1] = [' '];
        $this->recorrerJerarquia($this->data, 2, $rows);
        return $rows;
        
    }

    public function registerEvents(): array
    {   
        return [
            AfterSheet::class => function(AfterSheet $event) {
                
                $highestRow = $event->sheet->getHighestRow();
                $highestColumn = $event->sheet->getHighestDataColumn();

                $event->sheet->mergeCells('A1:B1');
                $event->sheet->setCellValue('A1','FIDEICOMISO DE TURISMO');

                $event->sheet->mergeCells('A2:B2');
                $event->sheet->setCellValue('A2', $this->municipios_name);

                 $event->sheet->getDelegate()->getStyle('A1:B2')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                foreach ($this->filasConNivel as $fila => $nivel) {
                    // Define colores por nivel
                    switch ($nivel) {
                        case 1:
                            $color = 'FFFFC000'; // Naranja
                            break;
                        case 2:
                            $color = '8DB4E2'; // azul claro
                            break;
                        case 3:
                            $color = 'DCE6F1'; // Azul claro
                            break;
                        default:
                            $color = 'FFFFFFFF'; // Blanco (sin color)
                            break;
                    }

                    $styleArray = [
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['argb' => $color],
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '000000'],
                            ],
                        ],
                    ];

                    // Aplica estilo a rango de columnas A y B (puedes ajustar si hay más columnas)
                    $event->sheet->getStyle("A{$fila}:B{$fila}")->applyFromArray($styleArray);
                }

                $event->sheet->getDelegate()->getStyle('B3:B'.$highestRow)->getNumberFormat()->setFormatCode('$#,##0.00');
            } 
        ];
    }

    protected function getCellColor(string $color = 'ffffc000') {
        return [
            'fill' => [
                'fillType'   => 'solid',
                'startColor' => ['argb' => $color],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color'       => ['argb' => '000000'],
                ],
            ],
        ];
    }

    protected function recorrerJerarquia($estructura, $nivel, &$rows)
    {
        foreach ($estructura as $nodo) {
            $nombre = $nodo['nombre'] ?? $nodo['partida']['nombre'];
            $presupuesto = $nodo['presupuesto'] ?? ($nodo['presupuesto_total'] ?? '');

            $rows[] = [$nombre, $presupuesto];

            // Guardamos la fila actual (última añadida) y nivel
            $filaActual = count($rows);
            $this->filasConNivel[$filaActual] = $nivel;

            if (isset($nodo['children']) && is_array($nodo['children'])) {
                $this->recorrerJerarquia($nodo['children'], $nivel + 1, $rows);
            }
        }
    }

}
