<?php

use App\Http\Controllers\Admin\DashboardController;

// Dashboard
Route::get('users',  [DashboardController::class, 'getLatestUsers'])->name('users');
Route::get('posts',  [DashboardController::class, 'getLatestPosts'])->name('posts');
Route::get('photos', [DashboardController::class, 'getLatestPhotos'])->name('photos');
Route::get('items',  [DashboardController::class, 'getLatestItems'])->name('items');
Route::get('server', [DashboardController::class, 'getServerStats'])->name('server');
