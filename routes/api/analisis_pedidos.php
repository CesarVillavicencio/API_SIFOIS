<?php

use App\Http\Controllers\Api\AnalisisPedidos\AnalisisPedidosController;

Route::post('get/excel', [AnalisisPedidosController::class, 'getExcelExport'])->name('get.excel');