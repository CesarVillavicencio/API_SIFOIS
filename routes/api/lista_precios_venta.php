<?php

use App\Http\Controllers\Api\ListasPreciosVenta\ListasPreciosVentaController;

// Route::get('prov/suggestions', [ListasPreciosCompraController::class, 'getProvSuggestions'])->name('prov.suggestions');
Route::get('get',                   [ListasPreciosVentaController::class, 'getArticles'])->name('getArticles');
Route::get('getDepartamentos',      [ListasPreciosVentaController::class, 'getDepartamentos'])->name('getDepartamentos');

Route::post('getExcel',             [ListasPreciosVentaController::class, 'getExcel'])->name('excelListaVentas'); // ->middleware('checkrights:lista_precios_venta.can_see_module');
Route::post('getExcelSeleccionados',[ListasPreciosVentaController::class, 'getExcelSeleccionados'])->name('excelListaVentas'); // ->middleware('checkrights:lista_precios_venta.can_see_module');

Route::post('getExcelSpecific',     [ListasPreciosVentaController::class, 'getExcelSpecific'])->name('excelListaSpecificVentas');
Route::post('uploadExcel',          [ListasPreciosVentaController::class, 'uploadExcel'])->name('listaVentasuploadExcel');

Route::get('getDataFromMongo',      [ListasPreciosVentaController::class, 'getDataFromMongo'])->name('ListaVentasGetDataFromMongo');
Route::post('updateValues',         [ListasPreciosVentaController::class, 'updateValues'])->name('listaVentasupdateValues');

Route::get('getCountData',          [ListasPreciosVentaController::class, 'getCountData'])->name('ListaVentasgetCountData');
Route::post('clearTempData',        [ListasPreciosVentaController::class, 'clearTempData'])->name('listaVentasClearTempData');

Route::get('getParametersListaPreciosVenta', [ListasPreciosVentaController::class, 'getParametersListaPreciosVenta'])->name('getParametersListaPreciosVenta');
// Route::post('get/excel',       [ListasPreciosCompraController::class, 'getExcelExport'])->name('get.excel');
// Route::post('set/excel',       [ListasPreciosCompraController::class, 'setExcelImport'])->name('set.excel');

Route::get('getPresentaciones',     [ListasPreciosVentaController::class, 'getPresentaciones'])->name('getPresentaciones');