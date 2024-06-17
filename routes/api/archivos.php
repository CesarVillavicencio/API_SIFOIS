<?php

use App\Http\Controllers\Api\Archivos\ArchivosController;

// Carpetas
Route::get('getFolders', [ArchivosController::class, 'getFolders'])->name('getFolders');
Route::get('getChildrens', [ArchivosController::class, 'getChildrens'])->name('getChildrens');
Route::get('getFolderNameById', [ArchivosController::class, 'getFolderNameById'])->name('getFolderNameById');

Route::post('createFolder', [ArchivosController::class, 'createFolder'])->name('createFolder');
Route::post('updateFolder', [ArchivosController::class, 'updateFolder'])->name('updateFolder');
Route::post('deleteFolder/{directory}', [ArchivosController::class, 'deleteFolder'])->name('deleteFolder');
Route::post('toggleVisible/{directory}', [ArchivosController::class, 'toggleVisible'])->name('toggleVisible');
Route::post('pasteFolder', [ArchivosController::class, 'pasteFolder'])->name('pasteFolder');

// Archivos
Route::post('upload', [ArchivosController::class, 'upload'])->name('upload');

Route::get('getFiles', [ArchivosController::class, 'getFiles'])->name('getFiles');
Route::get('getFile', [ArchivosController::class, 'getFile'])->name('getFile');
Route::post('uploadVersion', [ArchivosController::class, 'uploadVersion'])->name('uploadVersion');
Route::post('updateName', [ArchivosController::class, 'updateName'])->name('updateName');
Route::post('deleteArchivo/{archivo}', [ArchivosController::class, 'deleteArchivo'])->name('deleteArchivo');
Route::get('getFileNameById', [ArchivosController::class, 'getFileNameById'])->name('getFileNameById');
Route::post('pasteFile', [ArchivosController::class, 'pasteFile'])->name('pasteFile');

// Users
Route::get('getAllUsers', [ArchivosController::class, 'getAllUsers'])->name('getAllUsers');
Route::get('getAllUsersForFiles', [ArchivosController::class, 'getAllUsersForFiles'])->name('getAllUsersForFiles');
Route::get('getUserNameById', [ArchivosController::class, 'getUserNameById'])->name('getUserNameById');

// Route::post('sync', [ArchivosController::class, 'sync'])->name('sync');
// Route::post('syncFiles', [ArchivosController::class, 'syncFiles'])->name('syncFiles');

// folders-users-attach-detach
Route::get('getSharedUsers', [ArchivosController::class, 'getSharedUsers'])->name('getSharedUsers');
Route::get('getNonSharedUsers', [ArchivosController::class, 'getNonSharedUsers'])->name('getNonSharedUsers');
Route::post('attach', [ArchivosController::class, 'attach'])->name('attach');
Route::post('detach', [ArchivosController::class, 'detach'])->name('detach');

// Files-users-attach-detach
Route::get('getSharedUsersFiles', [ArchivosController::class, 'getSharedUsersFiles'])->name('getSharedUsersFiles');
Route::get('getNonSharedUsersFiles', [ArchivosController::class, 'getNonSharedUsersFiles'])->name('getNonSharedUsersFiles');
Route::post('attachFile', [ArchivosController::class, 'attachFile'])->name('attachFile');
Route::post('detachFile', [ArchivosController::class, 'detachFile'])->name('detachFile');

// SharedFiles
Route::get('getSharedFiles', [ArchivosController::class, 'getSharedFiles'])->name('getSharedFiles');
Route::post('toggleEditor', [ArchivosController::class, 'toggleEditor'])->name('toggleEditor');
Route::post('toggleEditorFiles', [ArchivosController::class, 'toggleEditorFiles'])->name('toggleEditorFiles');
