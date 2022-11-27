<?php

use App\Http\Controllers\Admin\{UserController};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::view('/','welcome');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::namespace('Admin')->middleware('auth')->group(function(){
    Route::prefix('users')->group(function(){
        Route::get('/',[UserController::class,'index'])->name('admin.users.index');
        Route::get('/add',[UserController::class,'add'])->name('admin.user.add');
        Route::post('/add',[UserController::class,'store'])->name('admin.user.store');
        Route::get('/{user}',[UserController::class,'edit'])->name('admin.user.edit');
        Route::put('/{user}',[UserController::class,'update'])->name('admin.user.update');
    });
});