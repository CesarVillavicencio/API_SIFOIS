<?php

use App\Http\Controllers\Api\ControlReports\ControlReportsController;

Route::middleware(['is.sysdba'])->group(function () {
    Route::get('get',    [ControlReportsController::class, 'getControlReportData'])->name('get');
    Route::post('set',   [ControlReportsController::class, 'setControlReportData'])->name('set');
});
