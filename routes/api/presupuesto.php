<?php

use App\Http\Controllers\Api\PresupuestosController;
use Illuminate\Support\Facades\Route;

// Presupuestos
Route::get('getAll',                [PresupuestosController::class, 'getAll'])->name('presupuestos.getAll');
Route::post('createPresupuesto',    [PresupuestosController::class, 'createPresupuesto'])->name('presupuestos.createPresupuesto');
Route::post('updatePresupuesto',    [PresupuestosController::class, 'updatePresupuesto'])->name('presupuestos.updatePresupuesto');
Route::post('deletePresupuesto',    [PresupuestosController::class, 'deletePresupuesto'])->name('presupuestos.deletePresupuesto');
Route::get('getMovimientos',        [PresupuestosController::class, 'getMovimientos'])->name('presupuestos.getMovimientos');
Route::post('toggleEstatus',        [PresupuestosController::class, 'toggleEstatus'])->name('presupuestos.toggleEstatus');
// Excel
Route::get('getExcel',              [PresupuestosController::class, 'getExcel'])->name('presupuestos.getExcel');


// Presupuesto-CI
Route::get('getPresupuestoCI',          [PresupuestosController::class, 'getPresupuestoCI'])->name('presupuestos.getPresupuestoCI');
Route::post('updateImporteMeses',       [PresupuestosController::class, 'updateImporteMeses'])->name('presupuestos.updateImporteMeses');
Route::get('getPartidasByPresupuesto',  [PresupuestosController::class, 'getPartidasByPresupuesto'])->name('presupuestos.getPartidasByPresupuesto');
Route::post('createPresupuestoCI',      [PresupuestosController::class, 'createPresupuestoCI'])->name('presupuestos.createPresupuestoCI');
Route::post('deletePresupuestoCI',      [PresupuestosController::class, 'deletePresupuestoCI'])->name('presupuestos.deletePresupuestoCI');
Route::get('getCIExcel',                [PresupuestosController::class, 'getExcelCI'])->name('presupuestos.getExcelCI');

//Presupuesto-Conceptos
Route::get('getPresupuestoConceptos',       [PresupuestosController::class, 'getPresupuestoConceptos'])->name('presupuestos.getPresupuestoConceptos');
Route::post('setPresupuestoConcepto',       [PresupuestosController::class, 'setPresupuestoConcepto'])->name('presupuestos.setPresupuestoConcepto');
Route::post('updatePresupuestoConcepto',    [PresupuestosController::class, 'updatePresupuestoConcepto'])->name('presupuestos.updatePresupuestoConcepto');
Route::post('deletePresupuestoConcepto',    [PresupuestosController::class, 'deletePresupuestoConcepto'])->name('presupuestos.deletePresupuestoConcepto');
Route::get('getExcelConceptos',             [PresupuestosController::class, 'getExcelConceptos'])->name('presupuestos.getExcelConceptos');


//MultipleSheetExport
Route::get('getMultipleExcel',              [PresupuestosController::class, 'getMultipleExcel'])->name('presupuestos.getMultipleExcel');