<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user',    [AuthController::class, 'getUser'])->name('user');
    Route::get('test',    [AuthController::class, 'getTest'])->name('test');

    // Partidas
    // Route::name('partidas.')->prefix('partidas')->group(__DIR__.'/api/partida.php');
});

Route::name('partida.')->prefix('partida')->group(__DIR__.'/api/partida.php');
Route::name('carta_instruccion.')->prefix('carta_instruccion')->group(__DIR__.'/api/carta_instruccion.php');
Route::name('beneficiario.')->prefix('beneficiario')->group(__DIR__.'/api/beneficiario.php');
Route::name('dashboard.')->prefix('dashboard')->group(__DIR__.'/api/dashboard.php');
Route::name('presupuesto.')->prefix('presupuesto')->group(__DIR__.'/api/presupuesto.php');
Route::name('presupuesto_partida.')->prefix('presupuesto_partida')->group(__DIR__.'/api/presupuesto_partida.php');
Route::name('bitacora.')->prefix('bitacora')->group(__DIR__.'/api/bitacora.php');
Route::name('rights.')->prefix('rights')->group(__DIR__.'/api/rights.php');

// **********************************
// Onlye Developing Testing Routes **
// **********************************
Route::middleware(['auth:api', 'is.env.local.or.staging'])->group(function () {
    Route::post('login-random-user', [AuthController::class, 'loginAsRandomUser'])->name('login-random-user');
});

Route::get('test',    [AuthController::class, 'test'])->name('test');
  