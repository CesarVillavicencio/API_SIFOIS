<?php

use App\Http\Controllers\Api\BitacoraController;
use Illuminate\Support\Facades\Route;

// Users
Route::get('get',            [BitacoraController::class, 'getBitacora'])->name('bitacora.get');
Route::get('getBitacoraById',            [BitacoraController::class, 'getBitacoraByID'])->name('bitacora.get');
