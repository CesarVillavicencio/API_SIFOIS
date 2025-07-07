<?php

use App\Http\Controllers\Api\CartaInstruccionController;

// Users
Route::get('getAll',          [CartaInstruccionController::class, 'getCartas'])->name('getCartas');
Route::get('getCarta',        [CartaInstruccionController::class, 'getCarta'])->name('getCarta');
Route::post('createCarta',    [CartaInstruccionController::class, 'createCartaInstruccion'])->name('createCartaInstruccion');
Route::post('updateCarta',    [CartaInstruccionController::class, 'updateCartaInstruccion'])->name('updateCartaInstruccion');
Route::post('deleteCarta',    [CartaInstruccionController::class, 'deleteCartaInstruccion'])->name('deleteCartaInstruccion');

// getAllMonthsAverageByYear
Route::get('getAllMonthsAverageByYear',     [CartaInstruccionController::class, 'getAllMonthsAverageByYear'])->name('getAllMonthsAverageByYear');
Route::get('getAllMunicipuosAvarage',     [CartaInstruccionController::class, 'getAllMunicipuosAvarage'])->name('getAllMunicipuosAvarage');
