<?php

use App\Http\Controllers\Api\BeneficiariosController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Test\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SiteController::class, 'home'])->name('home');

// ****************************************
// SPA Admin ******************************
// ****************************************
Route::get('/admin', [SiteController::class, 'admin'])->name('admin.app');
Route::get('/admin/{catchall?}', [SiteController::class, 'admin'])->where('catchall', '^(?!api).*$')->name('admin.app.2');

// **********************************
// Onlye Developing Testing Routes **
// **********************************
Route::middleware(['is.development'])->group(function () {
    Route::get('test', [TestController::class, 'test'])->name('test.test');
    // Route::get('testexcel', [TestController::class, 'testExcelExport'])->name('test.testexcel');
});


Route::get('webTest', [TestController::class, 'test'])->name('test');

Route::get('pdfTest', [BeneficiariosController::class, 'getExcel'])->name('getExcel');