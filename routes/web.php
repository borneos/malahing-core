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
    });
});