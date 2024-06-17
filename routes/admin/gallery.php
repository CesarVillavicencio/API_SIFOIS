<?php

use App\Http\Controllers\Admin\Gallery\CategoriesController;
use App\Http\Controllers\Admin\Gallery\PhotosController;

// Photos
Route::name('photos.')->prefix('photos')->group(function () {
    Route::get('get',        [PhotosController::class, 'getPhotos'])->name('get');
    Route::get('get/{id}',   [PhotosController::class, 'getPhoto'])->name('get.photo');
    Route::post('create',    [PhotosController::class, 'createPhoto'])->name('create');
    Route::post('update',    [PhotosController::class, 'updatePhoto'])->name('update');
    Route::post('delete',    [PhotosController::class, 'deletePhoto'])->name('delete');
    Route::post('image',     [PhotosController::class, 'uploadImage'])->name('image');
    Route::get('categories', [PhotosController::class, 'getCategories'])->name('categories');
    Route::post('category',  [PhotosController::class, 'addNewCategoryForPhoto'])->name('category.add');
});

// Categories
Route::name('categories.')->prefix('categories')->group(function () {
    Route::get('get', [CategoriesController::class, 'getCategories'])->name('get');
    Route::get('get/{id}', [CategoriesController::class, 'getCategory'])->name('category');
    Route::post('create', [CategoriesController::class, 'createCategory'])->name('create');
    Route::post('update', [CategoriesController::class, 'updateCategory'])->name('update');
    Route::post('delete', [CategoriesController::class, 'deleteCategory'])->name('delete');
});
