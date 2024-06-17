<?php

use App\Http\Controllers\Api\Rights\RightsController;

Route::middleware(['is.sysdba'])->group(function () {
    Route::get('get/users',   [RightsController::class, 'getUsers'])->name('get.users');
    Route::get('get/user',    [RightsController::class, 'getUserRights'])->name('get.user');
    Route::post('set/user',   [RightsController::class, 'setUserRights'])->name('set.user');
    Route::post('sync/users', [RightsController::class, 'syncUsers'])->name('sync.users');

    // Vendedores Pivot
    Route::get('get/vendedores',   [RightsController::class, 'getVendedores'])->name('get.vendedores');
    Route::post('set/vendedor',    [RightsController::class, 'setUserToVendedor'])->name('set.vendedor');
    Route::post('remove/vendedor', [RightsController::class, 'removeUserToVendedor'])->name('remove.vendedor');
});
