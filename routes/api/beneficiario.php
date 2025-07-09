<?php

use App\Http\Controllers\Api\BeneficiariosController;

// Users
Route::get('getAll',            [BeneficiariosController::class, 'getAll'])->name('beneficiario.getAll');
Route::get('getBeneficiario',   [BeneficiariosController::class, 'getBeneficiario'])->name('getBeneficiario');
Route::post('create',           [BeneficiariosController::class, 'createBeneficiario'])->name('createBeneficiario');
Route::post('update',           [BeneficiariosController::class, 'updateBeneficiario'])->name('updateBeneficiario');
Route::post('deleteBeneficiario', [BeneficiariosController::class, 'deleteBeneficiario'])->name('deleteBeneficiario');

// Para CI select *
Route::get('getAllSelect',            [BeneficiariosController::class, 'getAllSelect'])->name('beneficiario.getAllSelect');

// Excel
Route::get('getExcel',            [BeneficiariosController::class, 'getExcel'])->name('beneficiario.getExcel');