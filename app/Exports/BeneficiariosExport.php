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

class BeneficiariosExport implements FromArray, WithEvents, WithHeadings, ShouldAutoSize
{   

    protected $beneficiarios;
    
    public function __construct(array $beneficiarios)
    {
        // dd($beneficiarios);
        $this->beneficiarios = $beneficiarios;
    }

    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //      return $this->reservas;
    // }

    

    public function headings(): array
    {
        return array_keys($this->beneficiarios[0]); // Encabezados a partir del primer elemento
        
    }

    public function array():array
    {
        // return ['2','2'];
        return $this->beneficiarios;
    }

    public function registerEvents(): array
    {   
        return [
            AfterSheet::class => function(AfterSheet $event) {
                
                $highestRow = $event->sheet->getHighestRow();
                $highestColumn = $event->sheet->getHighestDataColumn();

                // foreach ($this->reservas as $key => $value) {
                //     $color = $value['color'];
                //     $fila = $key + 2;
                //     $hex = $this->rgba2hex($color);
                //     // dd($color, $hex);
                    
                //     $event->sheet->row($fila, function($row) use ($hex) { 
                //         if (!$hex) {return;}
                //         $row->setBackground($hex); 
                //     });
                //     $event->sheet->setHeight($fila, 20);           
                // }



                // $event->sheet->getDelegate()->getStyle('A1:'.$highestColumn.'1')
                //     ->getFill()
                //     ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                //     ->getStartColor()
                //     ->setARGB('249474');

                // $event->sheet->getDelegate()->getStyle('A2:A10')->applyFromArray($this->getCellColor('FCD5B4'));

                // $event->sheet->cell(1, function($row) { 
                //     $row->setBackground('#CCCCCC'); 
                // });
            }
        //    
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

}
