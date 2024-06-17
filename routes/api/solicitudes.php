<?php

use App\Http\Controllers\Api\SolicitudesClientes\SolicitudesClientesController;



// Get data
Route::get('getSolicitudes', [SolicitudesClientesController::class, 'getSolicitudes'])->name('getSolicitudes');
Route::get('getCliente', [SolicitudesClientesController::class, 'getCliente'])->name('getCliente');
Route::get('getArticulo', [SolicitudesClientesController::class, 'getArticulo'])->name('getArticulo');

Route::post('saveSolicitud', [SolicitudesClientesController::class, 'saveSolicitud'])->name('saveSolicitud')
->middleware('checkrights:solicitud_cliente.can_add_solicitudes');

Route::get('reporte', [SolicitudesClientesController::class, 'reporte'])->name('reporte');

Route::get('getSucursalesByUser', [SolicitudesClientesController::class, 'getSucursalesByUser'])->name('getSucursalesByUser');

Route::get('getDataClient', [SolicitudesClientesController::class, 'getDataClient'])->name('getDataClient');
// solicitudesClientesExcel
// Route::get('solicitudesExcel', [SolicitudesClientesController::class, 'reporte'])->name('solicitudCliente.reporte')
// ->middleware('checkrights:solicitud_cliente.can_add_solicitudes');