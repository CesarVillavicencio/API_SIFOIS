<?php

use App\Http\Controllers\Api\Reports\ReportsController;

// Get data
Route::get('getReporte', [ReportsController::class, 'getReporteDos'])->name('getReporte');
Route::get('getReporteCobranza', [ReportsController::class, 'getSaldos'])->name('getReporteSaldos');
Route::get('getReporteCobranzaDesglose', [ReportsController::class, 'getSaldos_desglose'])->name('getReporteCobranzaDesglose');
Route::get('test', [ReportsController::class, 'test'])->name('testReportes');
// Cortes sucursal
Route::get('getReporteCorte', [ReportsController::class, 'getReporteCorteSucursal'])->name('getReporteCorteSucursal');
Route::get('getReporteCortePDF', [ReportsController::class, 'getReporteCorteSucursalPDF'])->name('getReporteCorteSucursalPDF');


