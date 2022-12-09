<?php

use App\Http\Controllers\Admin\{BannersController, BlogCategoryController, BlogTags, BlogTagsController, UserController};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::view('/', 'welcome');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::namespace('Admin')->middleware('auth')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
    });

    Route::prefix('blog-category')->group(function () {
        Route::get('/', [BlogCategoryController::class, 'index'])->name('admin.blog-category.index');
        Route::get('/add', [BlogCategoryController::class, 'add'])->name('admin.blog-category.add');
        Route::post('/add', [BlogCategoryController::class, 'store'])->name('admin.blog-category.store');
        Route::get('/edit/{category:slug}', [BlogCategoryController::class, 'edit'])->name('admin.blog-category.edit');
        Route::put('/edit/{category:slug}', [BlogCategoryController::class, 'update'])->name('admin.blog-category.update');
        Route::delete('/{category:id}', [BlogCategoryController::class, 'delete'])->name('admin.blog-category.delete');
    });

    Route::prefix('blog-tags')->group(function () {
        Route::get('/', [BlogTagsController::class, 'index'])->name('admin.blog-tags.index');
    });

    Route::prefix('banners')->group(function () {
        Route::get('/', [BannersController::class, 'index'])->name('admin.banners.index');
    });
});
