<?php

use App\Http\Controllers\Api\ListasPreciosCompra\ListasPreciosCompraController;

Route::get('prov/suggestions', [ListasPreciosCompraController::class, 'getProvSuggestions'])->name('prov.suggestions');
Route::get('get',              [ListasPreciosCompraController::class, 'getProveedorData'])->name('get');
Route::post('get/excel',       [ListasPreciosCompraController::class, 'getExcelExport'])->name('get.excel');
Route::post('set/excel',       [ListasPreciosCompraController::class, 'setExcelImport'])->name('set.excel');
Route::post('add',             [ListasPreciosCompraController::class, 'addArticuloToLista'])->name('add');
