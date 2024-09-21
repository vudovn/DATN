<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::group(['middleware' => 'authenticated'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index'); 

    /* USER ROUTE */
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index'); 
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create'); 
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store'); 
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit'); 
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update'); 
    Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete'); 
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy'); 

});



Route::get('/admin', [AuthController::class, 'index'])->name('auth.index')->middleware('unauthenticated');
Route::post('/admin', [AuthController::class, 'login'])->name('auth.login');

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
