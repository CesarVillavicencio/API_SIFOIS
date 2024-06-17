<?php

use App\Http\Controllers\Api\VentasXVendedor\VentasXVendedorController;


Route::get('/clientes/get',   [VentasXVendedorController::class, 'getClientesDataFromVendedor'])->name('get.clientes');
Route::get('/vendedores/get', [VentasXVendedorController::class, 'getVendedores'])->name('get.vendedores');

