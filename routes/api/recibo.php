<?php

use App\Http\Controllers\Api\CE\ReciboController;

Route::middleware(['microsip.compras'])->group(function () {

    // Get Purchase Orders and Articles
    Route::get('get/orders',     [ReciboController::class, 'getPurchaseOrders'])->name('get.orders');
    Route::get('get/order/{id}', [ReciboController::class, 'getOrderDocsToVerify'])->name('get.order');

    // Complete Verification
    Route::post('verify', [ReciboController::class, 'saveOrderVerifiedDocs'])->name('verify.order');

    // Get Order MySQL Logs
    Route::get('get/logs/{id}', [ReciboController::class, 'getOrderLogs'])->name('get.order.logs');

    // Get Clave Data For FailLog From Failed Verification On Front
    Route::get('get/fail/clave/{clave}', [ReciboController::class, 'getClaveDataForFailLog'])->name('get.fail.clave');

    // Get Documento Contenedores
    Route::get('get/containers/{id}', [ReciboController::class, 'getDocContenedores'])->name('get.containers');

    // Get Pedimentos
    Route::get('get/pedimentos', [ReciboController::class, 'getPedimentos'])->name('get.pedimentos');

    // Retain Document
    Route::post('retain', [ReciboController::class, 'retainDocument'])->name('retain');
    Route::post('retain/remove', [ReciboController::class, 'removeRetainDocument'])->name('retain.remove');
});
