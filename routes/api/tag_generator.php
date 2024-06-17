<?php

use App\Http\Controllers\Api\TagGenerator\TagGeneratorController;


Route::get('get',               [TagGeneratorController::class, 'getArticulos'])->name('get');
Route::get('grupos_lineas/get', [TagGeneratorController::class, 'getGruposLineasData'])->name('get.grupos_lineas');
Route::post('generate',         [TagGeneratorController::class, 'saveGenerateTagsForView'])->name('generate');

