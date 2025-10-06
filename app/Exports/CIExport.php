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
use Maatwebsite\Excel\Concerns\WithTitle;

class CIExport implements FromArray, WithEvents, ShouldAutoSize
// , WithHeadings
, WithTitle
{   

    protected $data;
    protected $filasConNivel;
    
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->filasConNivel = [];
        
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
    //     return array_keys($this->data[0]); // Encabezados a partir del primer elemento
        
    // }

    public function array():array
    {
        // $data_array = [];
        // foreach ($this->data as $key => $d) {
        //     $data=[];
        //     $data[] = $d['beneficiario']['nombre'] .' '. $d['beneficiario']['apellido'];

        //     $data_array[] = $data; 
        // }
        // return $data_array;
        $rows = [];
        $rows[0] = [' '];
        // $rows[1] = [' '];
        $rows[1] = [' ','BENEFICIARIO','ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
        $rows[2] = [' '];
        $this->recorrerJerarquia($this->data, 2, $rows);
        return $rows;
    }

    public function title(): string
    {
        return 'Cartas Instriccion'; // This will be the sheet name
    }

    public function registerEvents(): array
    {   
        return [
            AfterSheet::class => function(AfterSheet $event) {
                
                $highestRow = $event->sheet->getHighestRow();
                $highestColumn = $event->sheet->getHighestDataColumn();

                $event->sheet->mergeCells('A1:B1');
                $event->sheet->setCellValue('A1','Nombre o clave de fideicomiso');

                // $event->sheet->mergeCells('A2:B2');
                $event->sheet->setCellValue('A2', 'MUNICIPIO_NAME');

                 $event->sheet->getDelegate()->getStyle('A1:B2')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                foreach ($this->filasConNivel as $fila => $nivel) {
                    // Define colores por nivel
                    switch ($nivel) {
                        case 1:
                            $color = 'FFFFC000'; // Naranja
                            break;
                        case 2:
                            $color = '8DB4E2'; // azul
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
                    $event->sheet->getStyle("A{$fila}:O{$fila}")->applyFromArray($styleArray);
                }

                $event->sheet->getDelegate()->getStyle('B3:O'.$highestRow)->getNumberFormat()->setFormatCode('$#,##0.00');

                for ($col = 'C'; $col <= 'N'; $col++) {
                    $cellCoordinate = $col . '4'; // e.g., C2, D2, ..., N2
                    $event->sheet->setCellValue($col.'3', "=SUM($cellCoordinate:$col$highestRow)");
                }
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
            $presupuesto = $nodo['presupuesto'] ?? ($nodo['importe'] ?? '');
            $beneficiario = isset($nodo['beneficiario']) ? $nodo['beneficiario']['nombre']  .' '. $nodo['beneficiario']['apellido']: ' ';
 
            $rows[] = [$nombre, $beneficiario,
            $nodo['importe_meses'][0]['importe'] ?? 0 , $nodo['importe_meses'][1]['importe'] ?? 0, $nodo['importe_meses'][2]['importe'] ?? 0, $nodo['importe_meses'][3]['importe'] ?? ' ', $nodo['importe_meses'][4]['importe'] ?? 0 , $nodo['importe_meses'][5]['importe'] ?? 0, $nodo['importe_meses'][6]['importe'] ?? 0, $nodo['importe_meses'][7]['importe'] ?? 0, $nodo['importe_meses'][8]['importe'] ?? 0, $nodo['importe_meses'][9]['importe'] ?? 0, $nodo['importe_meses'][10]['importe'] ?? 0, $nodo['importe_meses'][11]['importe'] ?? 0, 
            $presupuesto];

            // Guardamos la fila actual (última añadida) y nivel
            $filaActual = count($rows);
            $this->filasConNivel[$filaActual] = $nivel;

            if (isset($nodo['children']) && is_array($nodo['children'])) {
                $this->recorrerJerarquia($nodo['children'], $nivel + 1, $rows);
            }
        }
    }

    

}
