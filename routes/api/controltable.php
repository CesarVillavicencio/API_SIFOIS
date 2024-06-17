<?php

use App\Http\Controllers\Api\CE\ControlTableController;

Route::middleware(['is.sysdba'])->group(function () {

    // Get Orders And Traspasos
    Route::get('get', [ControlTableController::class, 'getOrdersAndTraspasos'])->name('get');
});
