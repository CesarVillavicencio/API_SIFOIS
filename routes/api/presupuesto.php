<?php

use App\Http\Controllers\Api\PresupuestosController;

// Excel
Route::get('getExcel',  [PresupuestosController::class, 'getExcel'])->name('presupuesto.getExcel');