<?php

use App\Http\Controllers\Api\PartidaController;
use Illuminate\Support\Facades\Route;

// Users
Route::get('getAll',            [PartidaController::class, 'getPartidas'])->name('getPartidas');
Route::get('getPartida',        [PartidaController::class, 'getPartida'])->name('getPartida');
Route::get('getPadres',        [PartidaController::class, 'getPadres'])->name('getPadres');
Route::post('createPartida',    [PartidaController::class, 'createPartida'])->name('createPartida');
Route::post('updatePartida',    [PartidaController::class, 'updatePartida'])->name('updatePartida');
Route::post('deletePartida',    [PartidaController::class, 'deletePartida'])->name('deletePartida');


