<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GarzaReynaLocal\Articulos;
use App\Models\Mongo\Reportes\VenArtAnual;
use App\Models\Mongo\Reportes\ProvArtAnual;
use App\Models\Mongo\Reportes\ProvArtMen;
use App\Models\Mongo\Reportes\VenArtMensual;
use App\Helpers\CharsetFix;
use App\Helpers\ArticulosHelpers;
use App\Helpers\ReportesHelper;
use App\Helpers\SucursalHelpers;
use Encoding;
use DivisionByZeroError;
use DB;

class Test extends Command {
    protected $signature = 'test:test';
    protected $description = 'Testing Command';
    public function handle() {
        
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        $timestamp_start = ReportesHelper::getDateTimeLocalString();
        $this->doJob();
        $timestamp_end = ReportesHelper::getDateTimeLocalString();
        $difference = ReportesHelper::diffInHours($timestamp_start, $timestamp_end);

        $this->info(' Update/Save To Mongo! Time: '.$difference);
    }

    protected function doJob() {
      
        /*
        $progressBar = $this->output->createProgressBar(count($records));
        $progressBar->start();

        $progressBar->advance();
        

        $progressBar->finish();
        */

        return true;
    }
}
