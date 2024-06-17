<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\Admin\SystemErrorsController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('background', [ConfigurationController::class, 'getAuthBackground'])->name('background'); // Auth Views Background Image

Route::middleware(['auth:admin', 'is.admin.user.blocked'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user', [AuthController::class, 'getUser'])->name('user');
    Route::get('check', [AuthController::class, 'getUserCheck'])->name('user.check');

    // Blog
    Route::name('blog.')->prefix('blog')->group(__DIR__.'/admin/blog.php');

    // Gallery
    Route::name('gallery.')->prefix('gallery')->group(__DIR__.'/admin/gallery.php');

    // Users
    Route::name('users.')->prefix('users')->group(__DIR__.'/admin/users.php');

    // Dashboard
    Route::name('dashboard.')->prefix('dashboard')->group(__DIR__.'/admin/dashboard.php');

    // Configuration
    Route::name('configuration.')->prefix('configuration')->group(__DIR__.'/admin/configuration.php');

    // System Errors
    Route::get('log/errors', [SystemErrorsController::class, 'getLogErrors'])->name('log.system.errors')->middleware('is.suadmin.user');
});

// **************************
// Onlye Developing Routes **
// **************************
Route::middleware(['is.dev.local.or.stagging'])->group(function () {
    Route::post('login-random-admin', [AuthController::class, 'loginAsRandomAdmin'])->name('login-random-admin');
});
