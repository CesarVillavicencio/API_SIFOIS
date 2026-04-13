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
    protected $mapMeses;
    
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->filasConNivel = [];
        $this->mapMeses=[
            'enero' => 1,
            'febrero' => 2,
            'marzo' => 3,
            'abril' => 4,
            'mayo' => 5,
            'junio' => 6,
            'julio' => 7,
            'agosto' => 8,
            'septiembre' => 9,
            'octubre' => 10,
            'noviembre' => 11,
            'diciembre' => 12,
        ];
        
    }

    public function array():array
    {

        $rows = [];
        $rows[0] = [' '];
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
            
            $meses = array_fill(1, 12, 0);

            foreach ($nodo['movimientos'] ?? [] as $mov) {
                $mesNombre = strtolower($mov['mes']);

                $mesNumero = $this->mapMeses[$mesNombre];
                $meses[$mesNumero] += $mov['importe'];
            }
            
            $rows[] = [$nombre, $beneficiario,
            $meses[1], $meses[2], $meses[3], $meses[4], $meses[5], $meses[6], $meses[7], $meses[8], $meses[9], $meses[10], $meses[11], $meses[12],
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
