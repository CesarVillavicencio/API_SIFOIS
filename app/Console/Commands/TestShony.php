<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exports\Reports\ProvArtExport;
use App\Services\Reports\UpdateVendedoresArticulos;
use App\Services\Reports\UpdateArticulosSinVentas;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Mongo\Reportes\CliArtMensual;
use App\Services\Reports\Reduced\GetCliDataArray;
use App\Services\Reports\UpdateClientesArticulos;
use App\Services\Reports\Reduced\UpdateClientesData;
use App\Exports\ListaPreciosCompraExport;
use App\Helpers\ReportesHelper;
use App\Helpers\CSVHelper;
use App\Models\User;
use App\Models\Mongo\Notification;
use App\Jobs\Test;
use App\Helpers\WSNotify;
use App\Helpers\Encoding;
use Carbon\Carbon;
use DB;

class TestShony extends Command {

    protected $signature = 'test:shony';
    protected $description = 'Testing Shony Shit Command';
    public function handle() {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        /*
        $isAnual = false;
        $data = new GetCliDataArray($isAnual, '2024-04-28');

        $filename = "reporte_clientes_mensual.csv";
        CSVHelper::LaravelNoMoveExcelToCSV($data->getArray(), $filename);


        $isAnual = true;
        $data = new GetCliDataArray($isAnual, '2024-04-28');

        $filename = "reporte_clientes_anual.csv";
        CSVHelper::LaravelNoMoveExcelToCSV($data->getArray(), $filename);
        
        return true;
        */
        
        
        

        
        
        $works = [
            ['2024-01-01', false],
            ['2024-02-01', false],
            ['2024-03-01', false],
            ['2024-04-01', true],
            ['2023-01-01', false],
            ['2023-02-01', false],
            ['2023-03-01', false],
            ['2023-04-01', false],
            ['2023-05-01', false],
            ['2023-06-01', false],
            ['2023-07-01', false],
            ['2023-08-01', false],
            ['2023-09-01', false],
            ['2023-10-01', false],
            ['2023-11-01', false],
            ['2023-12-01', true],
            ['2022-01-01', false],
            ['2022-02-01', false],
            ['2022-03-01', false],
            ['2022-04-01', false],
            ['2022-05-01', false],
            ['2022-06-01', false],
            ['2022-07-01', false],
            ['2022-08-01', false],
            ['2022-09-01', false],
            ['2022-10-01', false],
            ['2022-11-01', false],
            ['2022-12-01', true]
        ];

        foreach ($works as $work) {
            $job = new UpdateClientesArticulos($work[0], $work[1]);
            $result = $job->start();
            dump($work[0] . ' time: ' . $result['time']);
        }

        return true;
        
        
        





        $works = [
            ['2024-01-01', false],
            ['2024-02-01', false],
            ['2024-03-01', false],
            ['2024-04-01', true],
            ['2023-01-01', false],
            ['2023-02-01', false],
            ['2023-03-01', false],
            ['2023-04-01', false],
            ['2023-05-01', false],
            ['2023-06-01', false],
            ['2023-07-01', false],
            ['2023-08-01', false],
            ['2023-09-01', false],
            ['2023-10-01', false],
            ['2023-11-01', false],
            ['2023-12-01', true],
            ['2022-01-01', false],
            ['2022-02-01', false],
            ['2022-03-01', false],
            ['2022-04-01', false],
            ['2022-05-01', false],
            ['2022-06-01', false],
            ['2022-07-01', false],
            ['2022-08-01', false],
            ['2022-09-01', false],
            ['2022-10-01', false],
            ['2022-11-01', false],
            ['2022-12-01', true]
        ];

        foreach ($works as $work) {
            $job = new UpdateVendedoresClientesData($work[0], $work[1]);
            $result = $job->start();
            dump($work[0] . ' time: ' . $result['time']);
        }

        return true;


        /*
        $directory = config("filesystems.disks.csv.root").'/';
        $dus = new GetCliArtDataArray(false);
        $data_array = $dus->getArray();
        ReportesHelper::toCSV($data_array, $directory.'reporte_clientes_articulos_mensual_test.csv');

        /* Currently used memory */
        $mem_usage = memory_get_usage();
            
        /* Peak memory usage */
        $mem_peak = memory_get_peak_usage();

        /*
        dump('The script is now using: ' . round($mem_usage / 1024) . 'KB of memory.');
        dump('Peak usage: ' . round($mem_peak / 1024) . 'KB of memory.');

        return true;
        */



        /* ! ----------------------------- */

        /*
        $job = new UpdateClientesData();
        $result = $job->start();
        dump('UpdateArticulosSinVentas time: ' . $result['time']);
        return true;
        */

        // Excel::store(new ProvArtExport(true), 'reporte_proveedores_articulos_anual.xlsx', 'excel');
        // Excel::store(new ProvArtExport(false), 'reporte_proveedores_articulos_mensual.xlsx', 'excel');

        // Excel::store(new VenArtExport(true), 'reporte_vendedores_articulos_anual.xlsx', 'excel');
        // Excel::store(new VenArtExport(false), 'reporte_vendedores_articulos_mensual.xlsx', 'excel');
        /*
        $works = [
            ['2024-01-01', false],
            ['2024-02-01', true],
        ];
        */

        Test::dispatch();
        return true;




        

        $user = User::where('name', 'SYSDBA')->first();

        $notification = Notification::create([
            'title'   => 'Notficación',
            'message' => 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles.',
            'read'    => 0,
            'icon'    => 'bell',
            'id_user' => $user->id
        ]);

        return true;




        /*
        $isAnual = false;
        $almData = new GetCliDataArray($isAnual);
        $data_array = $almData->getArray();

        $filename = "testing_reduce.csv";
        CSVHelper::LaravelNoMoveExcelToCSV($data_array, $filename);
        
        return true;
        */

        /*
        $job = new UpdateProveedoresArticulos('2024-02-26', false);
        $result = $job->start();
        dump('2024-02-26 time: ' . $result['time']);

        return true;
        */
        


        /*
        $works = [
            ['2024-01-01', false],
            ['2024-02-01', true],
            ['2023-01-01', false],
            ['2023-02-01', false],
            ['2023-03-01', false],
            ['2023-04-01', false],
            ['2023-05-01', false],
            ['2023-06-01', false],
            ['2023-07-01', false],
            ['2023-08-01', false],
            ['2023-09-01', false],
            ['2023-10-01', false],
            ['2023-11-01', false],
            ['2023-12-01', true],
        ];
        

        
        $job = new UpdateGruposLineasMongo;
        $result = $job->start();
        dump('time: ' . $result['time']);

        return true;


        /*
        $job = new UpdateProveedoresArticulos('2024-02-26', false);
        $result = $job->start();
        dump('2024-02-26 time: ' . $result['time']);

        return true;
        */
        


        /*
        $works = [
            ['2024-01-01', false],
            ['2024-02-01', true],
            ['2023-01-01', false],
            ['2023-02-01', false],
            ['2023-03-01', false],
            ['2023-04-01', false],
            ['2023-05-01', false],
            ['2023-06-01', false],
            ['2023-07-01', false],
            ['2023-08-01', false],
            ['2023-09-01', false],
            ['2023-10-01', false],
            ['2023-11-01', false],
            ['2023-12-01', true],
            ['2022-01-01', false],
            ['2022-02-01', false],
            ['2022-03-01', false],
            ['2022-04-01', false],
            ['2022-05-01', false],
            ['2022-06-01', false],
            ['2022-07-01', false],
            ['2022-08-01', false],
            ['2022-09-01', false],
            ['2022-10-01', false],
            ['2022-11-01', false],
            ['2022-12-01', true]
        ];
        
        dump('UpdateArticulosMargen');

        foreach ($works as $work) {
            $job = new UpdateArticulosMargen($work[0], $work[1]);
            $result = $job->start();
            dump($work[0] . ' time: ' . $result['time']);
        }

        dump('UpdateAlmacenesArticulos');

        foreach ($works as $work) {
            $job = new UpdateArticulosMargen($work[0], $work[1]);
            $result = $job->start();
            dump($work[0] . ' time: ' . $result['time']);
        }

        dump('UpdateKPIVendedores');

        foreach ($works as $work) {
            $job = new UpdateArticulosMargen($work[0], $work[1]);
            $result = $job->start();
            dump($work[0] . ' time: ' . $result['time']);
        }

        dump('UpdateAlmacenesArticulos');

        foreach ($works as $work) {
            $job = new UpdateKPIVendedores($work[0], $work[1]);
            $result = $job->start();
            dump($work[0] . ' time: ' . $result['time']);
        }

        dump('UpdateKPIVendedores');

        foreach ($works as $work) {
            $job = new UpdateKPIVendedores($work[0], $work[1]);
            $result = $job->start();
            dump($work[0] . ' time: ' . $result['time']);
        }
        */

        /*
        $job = new UpdateClientesArticulos;
        $result = $job->start();

        dump($result);
        */

        // Excel::import(new UsersImport, request()->file('your_file'));
        // Excel::import(new ListaPreciosCompraImport, 'test.xlsx', 'excel');
        // Excel::import(new UpdateLineasArticulosImport, 'lineas_articulos_update.xlsx', 'excel');

        // Excel::store(new VentasPerdidasExport('2023-10-01', '2024-02-14'), 'test_octubre_febrero.xlsx', 'excel');
        // Excel::store(new VentasPerdidasExport('2024-01-01', '2024-01-31'), 'test_enero.xlsx', 'excel');
        // Excel::store(new VentasPerdidasExport('2024-01-01', '2024-02-29'), 'test_febrero.xlsx', 'excel');


        // Excel::store(new ListaPreciosCompraExport(29347, 343835), 'test.xlsx', 'excel');

        /*
        Excel::store(new ProvArtExport(true), 'reporte_proveedores_articulos_anual.xlsx', 'excel');
        Excel::store(new ProvArtExport(false), 'reporte_proveedores_articulos_mensual.xlsx', 'excel');
        */


        /*$directory = config("filesystems.disks.csv.root").'/';
        $provArt = new GetProvArtDataArray(true);
        $data_array = $provArt->getArray();
        ReportesHelper::toCSV($data_array, $directory.'reporte_proveedores_articulos_anual.csv');

        $provArt = new GetProvArtDataArray(false);
        $data_array = $provArt->getArray();
        ReportesHelper::toCSV($data_array, $directory.'reporte_proveedores_articulos_mensual.csv');*/

        /*
        $directory = config("filesystems.disks.csv.root");
        $subDirectory = '2023/12/01_de_diciembre_al_31_de_diciembre'; // ReportesHelper::getCustomSaveReportDirectory();
        $cleanDirectory = str_replace("\\", "/", $directory);
        $baseDirectory = $cleanDirectory . "/" . $subDirectory;

        // Make Zips
        // $this->doZip($baseDirectory);

        // Update Record Mongo
        $this->doMongo($baseDirectory, $subDirectory);*/


       
    }
}
