<?php

use App\Http\Controllers\Api\Catalogo\AlmacenController;
use App\Http\Controllers\Api\Catalogo\ArticuloController;
use App\Http\Controllers\Api\Catalogo\CatalogoController;
use App\Http\Controllers\Api\Catalogo\GrupoLineaController;
use App\Http\Controllers\Api\Catalogo\LineaController;
use App\Http\Controllers\Api\Catalogo\SucursalController;
use App\Http\Controllers\Api\Catalogo\TemplateController;

// Articles
Route::post('getArticlesByFilters', [ArticuloController::class, 'getArticlesByFilters'])->name('getArticlesByFilters');

// presentacion
// Branches
Route::get('getPresentaciones', [CatalogoController::class, 'getPresentaciones'])->name('getPresentacionesCatalogs');
// Branches
Route::get('getBranches', [SucursalController::class, 'getBranches'])->name('getBranches');

// Catalogs
Route::apiResource('', CatalogoController::class);

// Groups
Route::get('getGroups', [GrupoLineaController::class, 'getGroups'])->name('getGroups');

// Lines
Route::get('getLines', [LineaController::class, 'getLines'])->name('getLines');
Route::get('getLinesByGroup/{groupID}', [LineaController::class, 'getLinesByGroup'])->name('getLinesByGroup');

// Templates
Route::get('getTemplates', [TemplateController::class, 'getTemplates'])->name('getTemplates');
Route::get('getTemplate/{templateID}', [TemplateController::class, 'getTemplate'])->name('getTemplate');

// Warehouses
Route::get('getWarehouses', [AlmacenController::class, 'getWarehouses'])->name('getWarehouses');
Route::get('getWarehousesByBranch/{branchID}', [AlmacenController::class, 'getWarehousesByBranch'])->name('getWarehousesByBranch');

// Cesar
// Route::get('getArticulos', [CatalogoController::class, 'getArticulos'])->name('getArticulos');
Route::get('getArticulos', [CatalogoController::class, 'getArticulosMongo'])->name('getArticulos');
Route::get('getBrands', [CatalogoController::class, 'getBrands'])->name('getBrands');
Route::get('getColors', [CatalogoController::class, 'getColors'])->name('getColors');
Route::get('getClasificadoresEspeciales', [CatalogoController::class, 'getClasificadoresEspeciales'])->name('getCgetClasificadoresEspecialesolors');


Route::post('getImages', [CatalogoController::class, 'getImages'])->name('getImages');
Route::post('uploadImage', [CatalogoController::class, 'uploadImage'])->name('uploadImage');

Route::post('create', [CatalogoController::class, 'create'])->name('create');

Route::get('show/{catalog}', [CatalogoController::class, 'show'])->name('show');
Route::post('destroy/{catalog}', [CatalogoController::class, 'destroy'])->name('destroy');
Route::post('update/{catalog}', [CatalogoController::class, 'update'])->name('update');
Route::post('toggleStatus/{catalog}', [CatalogoController::class, 'toggleStatus'])->name('toggleStatus');

Route::post('getBrandsById', [CatalogoController::class, 'getBrandsById'])->name('getBrandsById');

Route::post('uploadSingleImage', [CatalogoController::class, 'uploadSingleImage'])->name('uploadSingleImage');
Route::post('deleteSingleImage', [CatalogoController::class, 'deleteSingleImage'])->name('deleteSingleImage');
// uploadImage and saveit to microsip_article_image
Route::post('uploadAndSaveImage', [CatalogoController::class, 'uploadAndSaveImage'])->name('uploadAndSaveImage');


Route::post('uploadSingleImagePortada', [CatalogoController::class, 'uploadSingleImagePortada'])->name('uploadSingleImagePortada');
Route::post('updatePosition', [CatalogoController::class, 'updatePosition'])->name('updatePosition');
Route::post('updateColumn/{catalog}', [CatalogoController::class, 'updateColumn'])->name('updateColumn');
Route::post('uploadSingleBannerPortada', [CatalogoController::class, 'uploadSingleBannerPortada'])->name('uploadSingleBannerPortada');

Route::post('sync/{catalog}', [CatalogoController::class, 'sync'])->name('sync');

// Logos
Route::post('uploadLogo', [CatalogoController::class, 'uploadLogo'])->name('uploadLogo');
Route::get('getAviablesLogos', [CatalogoController::class, 'getAviablesLogos'])->name('getAviablesLogos');
// 
// sysdba Routes
Route::post('truncate', [CatalogoController::class, 'truncate'])->name('truncate');


Route::get('generatePDF/{catalog}', [CatalogoController::class, 'generatePDF'])->name('generatePDF');
Route::get('generatePDFTest', [CatalogoController::class, 'generatePDFTest'])->name('generatePDFTest');

// news
Route::post('deleteProductImage', [CatalogoController::class, 'deleteProductImage'])->name('deleteProductImage');

// Route::post('getSeleccionadosSync', [CatalogoController::class, 'getSeleccionadosSync'])->name('getSeleccionadosSync');
Route::post('getSeleccionadosSync', [CatalogoController::class, 'getSeleccionadosSyncMongo'])->name('getSeleccionadosSyncMongo');

Route::post('uploadImageMarca', [CatalogoController::class, 'uploadImageMarca'])->name('uploadImageMarca');


Route::get('getSubfamiliasGrupos', [CatalogoController::class, 'getSubfamiliasGrupos'])->name('getSubfamiliasGrupos');
