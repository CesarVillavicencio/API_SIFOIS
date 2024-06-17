<?php

use App\Http\Controllers\Admin\Blog\CategoriesController;
use App\Http\Controllers\Admin\Blog\PostsController;

// Posts
Route::name('posts.')->prefix('posts')->group(function () {
    Route::get('get', [PostsController::class, 'getPosts'])->name('get');
    Route::get('get/{id}', [PostsController::class, 'getPost'])->name('get.post');
    Route::post('create', [PostsController::class, 'createPost'])->name('create');
    Route::post('update', [PostsController::class, 'updatePost'])->name('update');
    Route::post('delete', [PostsController::class, 'deletePost'])->name('delete');
    Route::post('image', [PostsController::class, 'uploadImage'])->name('image');
    Route::post('publish', [PostsController::class, 'togglePublish'])->name('publish');
    Route::get('categories', [PostsController::class, 'getCategories'])->name('categories');
    Route::post('category', [PostsController::class, 'addNewCategoryForPost'])->name('category.add');
});

// Categories
Route::name('categories.')->prefix('categories')->group(function () {
    Route::get('get', [CategoriesController::class, 'getCategories'])->name('get');
    Route::get('get/{id}', [CategoriesController::class, 'getCategory'])->name('category');
    Route::post('create', [CategoriesController::class, 'createCategory'])->name('create');
    Route::post('update', [CategoriesController::class, 'updateCategory'])->name('update');
    Route::post('delete', [CategoriesController::class, 'deleteCategory'])->name('delete');
});
