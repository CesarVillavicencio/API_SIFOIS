<?php

use App\Http\Controllers\Api\DashboardController;

// Users
Route::get('getChartData',          [DashboardController::class, 'getChartData'])->name('getChartData');
Route::get('getChartMunicipios',    [DashboardController::class, 'getChartMunicipios'])->name('getChartMunicipios');
Route::get('getChartYearMonths',    [DashboardController::class, 'getChartYearMonths'])->name('getChartYearMonths');


