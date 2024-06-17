<?php

use App\Http\Controllers\Admin\ConfigurationController;

// Dashboard
Route::get('get',         [ConfigurationController::class, 'getConfiguration'])->name('get');
Route::post('contact',    [ConfigurationController::class, 'setContact'])->name('contact');
Route::post('colors',     [ConfigurationController::class, 'setColors'])->name('colors');
Route::post('background', [ConfigurationController::class, 'setLoginBackground'])->name('background');
Route::post('effects',    [ConfigurationController::class, 'setEffects'])->name('effects');
Route::post('siteup',     [ConfigurationController::class, 'setSiteUp'])->name('siteup');
Route::post('headsearch', [ConfigurationController::class, 'setSearchHeader'])->name('headsearch');
Route::post('shortcuts',  [ConfigurationController::class, 'setShortcuts'])->name('shortcuts');
Route::post('logo',       [ConfigurationController::class, 'setAdminLogo'])->name('logo');
Route::post('language',   [ConfigurationController::class, 'setLanguage'])->name('language');
Route::post('background/reset', [ConfigurationController::class, 'resetLoginBackground'])->name('background.reset');
