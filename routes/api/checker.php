<?php

use App\Http\Controllers\Api\Checker\CheckerController;

// Get data
Route::get('getProductos', [CheckerController::class, 'getProductos'])->name('getProductos');
Route::get('getPriceData', [CheckerController::class, 'getPriceData'])->name('getPriceData');

// Get Almacenes & Get Existencias From Alamcen
Route::get('almacenes/sucursales/get', [CheckerController::class, 'getAlmacenesAndSucursales'])->name('chechker.almacenes.sucursales.get');
Route::get('almacenes/get', [CheckerController::class, 'getAlmacenesFromSucursal'])->name('checker.almacenes.get');
// Route::get('almacen/stock', [LocateController::class, 'getAlmacenStock'])->name('almacen.stock');
