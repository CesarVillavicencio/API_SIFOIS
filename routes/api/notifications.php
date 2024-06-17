<?php

use App\Http\Controllers\Api\UserNotificationsController;

// Get User Notifications
Route::get('get', [UserNotificationsController::class, 'getUserNotifications'])->name('get');

// Get Users To Notify Routes
Route::get('get/users', [UserNotificationsController::class, 'getUsers'])->name('get.users');
Route::post('send/user', [UserNotificationsController::class, 'sendNotificationToUser'])->name('send.user');