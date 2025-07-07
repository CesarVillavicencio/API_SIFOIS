<?php

use App\Http\Controllers\Api\BeneficiariosController;

// Users
Route::get('getAll',            [BeneficiariosController::class, 'getAll'])->name('api.getAll');
Route::get('getBeneficiario',   [BeneficiariosController::class, 'getBeneficiario'])->name('getBeneficiario');
Route::post('create',           [BeneficiariosController::class, 'createBeneficiario'])->name('createBeneficiario');
Route::post('update',           [BeneficiariosController::class, 'updateBeneficiario'])->name('updateBeneficiario');
Route::post('deleteBeneficiario', [BeneficiariosController::class, 'deleteBeneficiario'])->name('deleteBeneficiario');