<?php

use App\Http\Controllers\Api\RightsController;
use Illuminate\Support\Facades\Route;

// Users
Route::get('getUsers', [RightsController::class, 'getUsers'])->name('rights.getUsers');
Route::get('getDerechos', [RightsController::class, 'getDerechos'])->name('rights.getDerechos');
// 
Route::get('getRights', [RightsController::class, 'getRights'])->name('rights.getRights'); 
// 
Route::post('toggleRight', [RightsController::class, 'toggleRight'])->name('rights.toggleRight');


