<?php

use App\Http\Controllers\Admin\UsersController;

// Users
Route::get('get',       [UsersController::class, 'getUsers'])->name('get');
Route::get('get/{id}',  [UsersController::class, 'getUser'])->name('get.user');
Route::post('create',   [UsersController::class, 'createUser'])->name('create');
Route::post('update',   [UsersController::class, 'updateUser'])->name('update');
Route::post('delete',   [UsersController::class, 'deleteUser'])->name('delete');
Route::post('avatar',   [UsersController::class, 'uploadAvatar'])->name('avatar');
Route::post('block',    [UsersController::class, 'toggleBlock'])->name('block');
Route::post('password', [UsersController::class, 'updatePassword'])->name('password');
