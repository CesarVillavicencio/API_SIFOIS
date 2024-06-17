<?php

use App\Http\Controllers\Api\FilesReports\FilesReportsController;


Route::get('get/years',   [FilesReportsController::class, 'getYearFolders'])->name('get.year');
Route::get('get/months',  [FilesReportsController::class, 'getMonthFolders'])->name('get.month');
Route::get('get/periods', [FilesReportsController::class, 'getPeriodsFolders'])->name('get.periods');
Route::get('get/files',   [FilesReportsController::class, 'getFiles'])->name('get.files');