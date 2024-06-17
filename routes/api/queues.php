<?php

use App\Http\Controllers\Api\Queues\QueuesController;

Route::get('get',         [QueuesController::class, 'getUserQueues'])->name('queues.get');
Route::get('delete/all',  [QueuesController::class, 'deleteAllUserQueuesAndFiles'])->name('queues.delete.all');
Route::get('delete/{id}', [QueuesController::class, 'deleteUserQueueAndFile'])->name('queues.delete');
