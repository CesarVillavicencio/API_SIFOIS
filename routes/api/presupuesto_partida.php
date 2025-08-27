<?php

use App\Http\Controllers\Api\PresupuestosController;
use Illuminate\Support\Facades\Route;

Route::get('getAll',      [PresupuestosController::class, 'getAllPP'])->name('PresupuestoPartida.getall');
Route::post('createPP',   [PresupuestosController::class, 'createPP'])->name('PresupuestoPartida.createPP');
Route::post('updatePP',   [PresupuestosController::class, 'updatePP'])->name('PresupuestoPartida.updatePP');
Route::post('deletePP',   [PresupuestosController::class, 'deletePP'])->name('PresupuestoPartida.deletePP');