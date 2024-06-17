<?php

use App\Http\Controllers\Api\CE\EmpquesController;

Route::middleware([])->group(function () {
    Route::get('get',      [EmpquesController::class, 'getEmpaques'])->name('get');
    Route::post('create',  [EmpquesController::class, 'createEmpaque'])->name('create');
    Route::post('update',  [EmpquesController::class, 'updateEmpaque'])->name('update');
    Route::post('delete',  [EmpquesController::class, 'deleteEmpaque'])->name('delete');
    Route::post('default', [EmpquesController::class, 'setDefaultEmpaque'])->name('default');
});
