<?php

use App\Http\Controllers\Admin\{BannerController, BlogCategoryController, BlogController, BlogTagsController, UserController};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::view('/', 'welcome');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::namespace('Admin')->middleware('auth')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/add', [UserController::class, 'add'])->name('admin.user.add');
        Route::post('/add', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/{user}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('admin.user.update');
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

    Route::prefix('blogs')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('admin.blogs.index');
        Route::get('/add', [BlogController::class, 'add'])->name('admin.blogs.add');
        Route::post('/add', [BlogController::class, 'store'])->name('admin.blogs.store');
        Route::get('/status/{id}/{status}', [BlogController::class, 'status'])->name('admin.blogs.status');
        Route::get('/edit/{blog:id}', [BlogController::class, 'edit'])->name('admin.blogs.edit');
        Route::put('/edit/{blog:id}', [BlogController::class, 'update'])->name('admin.blogs.update');
        Route::delete('/{blog:id}', [BlogController::class, 'delete'])->name('admin.blogs.delete');
    });

    Route::prefix('banners')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('admin.banners.index');
        Route::get('/add', [BannerController::class, 'add'])->name('admin.banners.add');
        Route::post('/add', [BannerController::class, 'store'])->name('admin.banners.store');
        Route::get('/status/{id}/{status}', [BannerController::class, 'status'])->name('admin.banners.status');
        Route::get('/edit/{banner:id}', [BannerController::class, 'edit'])->name('admin.banners.edit');
        Route::put('/edit/{banner:id}', [BannerController::class, 'update'])->name('admin.banners.update');
        Route::delete('/{banner:id}', [BannerController::class, 'delete'])->name('admin.banners.delete');
    });
});
