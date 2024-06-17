<?php

use App\Http\Controllers\Api\Parameters\ParametersController;

// Get data
Route::get('getListaPreciosVenta', [ParametersController::class, 'getListaPreciosVenta'])->name('getListaPreciosVenta');
Route::get('getPoliticasDsctoVol', [ParametersController::class, 'getPoliticasDsctoVol'])->name('getPoliticasDsctoVol ');
Route::post('createPolitica', [ParametersController::class, 'createPolitica'])->name('createPolitica ');
Route::post('setParameters', [ParametersController::class, 'setParameters'])->name('setParameters'); 
Route::get('getPoliticasDescuentoParameters', [ParametersController::class, 'getPoliticasDescuentoParameters'])->name('getPoliticasDescuentoParameters'); 
Route::get('getMailConfigurationParameters', [ParametersController::class, 'getMailConfigurationParameters'])->name('getMailConfigurationParameters'); 

Route::post('setParametersCorreo', [ParametersController::class, 'setParametersCorreo'])->name('setParametersCorreo'); 

