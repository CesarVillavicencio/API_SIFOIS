<?php

use App\Http\Controllers\Api\Locate\LocateController;
use App\Http\Controllers\Api\Locate\ZonesController;


// Get Locate Zones
Route::get('location/zones', [LocateController::class, 'getLocateZones'])->name('location.zones');

// Get Almacenes & Get Existencias From Alamcen
Route::get('almacenes/sucursales/get', [LocateController::class, 'getAlmacenesAndSucursales'])->name('almacenes.sucursales.get');
Route::get('almacenes/get', [LocateController::class, 'getAlmacenesFromSucursal'])->name('almacenes.get');
Route::get('almacen/stock', [LocateController::class, 'getAlmacenStock'])->name('almacen.stock');

// Get Almacenes & Get Existencias From Alamcen - Modals Data
Route::get('almacen/pedidos_traspasos_list_modal', [LocateController::class, 'getPedidosAndTraspasosListForModal'])->name('almacen.pedidos_traspasos_list_modal');
Route::get('almacen/por_recibir_list_modal', [LocateController::class, 'getPorRecibirListForModal'])->name('almacen.por_recibir_list_modal');
Route::get('almacen/por_surtir_list_modal', [LocateController::class, 'getPorSurtirListForModal'])->name('almacen.por_surtir_list_modal');
Route::get('almacen/por_recibir_traspasos_list_modal', [LocateController::class, 'getPorRecibirTraspasosList'])->name('almacen.por_recibir_traspasos_list_modal');
Route::get('almacen/por_surtir_traspasos_list_modal', [LocateController::class, 'getPorSurtirTraspasosList'])->name('almacen.por_surtir_traspasos_list_modal');

// Get Suggestions & Article Data
Route::get('suggestions', [LocateController::class, 'getArticleSuggestions'])->name('suggestions')->middleware('locate.can.open');
Route::get('get',         [LocateController::class, 'getArticleData'])->name('get')->middleware('locate.can.open');

// Save Article Data
Route::post('save', [LocateController::class, 'saveArticleData'])->name('save')->middleware('locate.can.modify');

// Upload Article Image
Route::post('image', [LocateController::class, 'uploadArticleImage'])->name('image')->middleware('checkrights:localiza.can_update_image');

// Zones Routes (Only Admins)
// TIP: zones:can_modify_almacenes|can_modify_almacen_a_b = "can_modify_almacenes|can_modify_almacen_a_b"
Route::middleware(['zones:localiza.can_modify_almacenes'])->group(function () {

    // Gets
    Route::get('zones/zones',      [ZonesController::class, 'getLocateZones'])->name('zones.zones');
    Route::get('zones/aisles',     [ZonesController::class, 'getAisles'])->name('zones.aisles');
    Route::get('zones/racks',      [ZonesController::class, 'getRacks'])->name('zones.racks');
    Route::get('zones/racklevels', [ZonesController::class, 'getRackLevels'])->name('zones.racklevels');

    // Add New One
    Route::post('zones/zone',      [ZonesController::class, 'saveLocateZone'])->name('zones.zone');
    Route::post('zones/aisle',     [ZonesController::class, 'saveAisle'])->name('zones.aisle');
    Route::post('zones/rack',      [ZonesController::class, 'saveRack'])->name('zones.rack');
    Route::post('zones/racklevel', [ZonesController::class, 'saveRackLevel'])->name('zones.racklevel');

    // Delete
    Route::delete('zones/zone/{id}',      [ZonesController::class, 'deleteLocateZone'])->name('zones.zone');
    Route::delete('zones/aisle/{id}',     [ZonesController::class, 'deleteAisle'])->name('zones.aisle');
    Route::delete('zones/rack/{id}',      [ZonesController::class, 'deleteRack'])->name('zones.rack');
    Route::delete('zones/racklevel/{id}', [ZonesController::class, 'deleteRackLevel'])->name('zones.racklevel');
});
