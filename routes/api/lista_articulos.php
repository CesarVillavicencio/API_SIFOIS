<?php

use App\Http\Controllers\Api\ListasArticulos\ListasArticulosController;

// Route::get('prov/suggestions', [ListasPreciosCompraController::class, 'getProvSuggestions'])->name('prov.suggestions');
// Route::get('get',              [ListasPreciosCompraController::class, 'getProveedorData'])->name('get');
Route::post('get/excel',       [ListasArticulosController::class, 'getExcelArticulos'])->name('get.excel.articulos');
Route::post('get/excelSeleccionados', [ListasArticulosController::class, 'getExcelArticulosSeleccionados'])->name('get.excel.articulosSeleccionados');
Route::post('upload/excel',       [ListasArticulosController::class, 'uploadExcel'])->name('upload.excel.articulos');
Route::get('getFromMongo',       [ListasArticulosController::class, 'getFromMongo'])->name('getFromMongo');

Route::post('createOrUpdate',       [ListasArticulosController::class, 'createOrUpdate'])->name('createOrUpdateListaArticulos');

Route::get('getCountData',       [ListasArticulosController::class, 'getCountData'])->name('listaArticulosGetCountData');