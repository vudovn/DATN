<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;

use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::group(['middleware' => 'authenticated'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    /* USER ROUTE */
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/index', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    /* PRODUCT ROUTE */
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/index', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
        Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    /* PRODUCT ROUTE */
    Route::prefix('product/attribute')->name('product.attribute.')->group(function () {
        Route::get('/index', [AttributeController::class, 'index'])->name('index');
        Route::get('/create', [AttributeController::class, 'create'])->name('create');
        Route::post('/store', [AttributeController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AttributeController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AttributeController::class, 'delete'])->name('delete');
        Route::delete('/destroy/{id}', [AttributeController::class, 'destroy'])->name('destroy');
    });

    /* PRODUCT ROUTE */
    Route::prefix('product/attribute-value')->name('product.attributeValue.')->group(function () {
        Route::get('/index/{attribute_id}', [AttributeValueController::class, 'index'])->name('index');
        Route::get('/create', [AttributeValueController::class, 'create'])->name('create');
        Route::post('/store', [AttributeValueController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AttributeValueController::class, 'edit'])->name('edit');
        Route::put('/update', [AttributeValueController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AttributeValueController::class, 'delete'])->name('delete');
        Route::delete('/destroy/{id}', [AttributeValueController::class, 'destroy'])->name('destroy');
    });


    /* AJAX ROUTE */
    Route::put('/change/status', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus');
    Route::put('/actions', [AjaxDashboardController::class, 'changeStatusMultiple'])->name('ajax.dashboard.changeStatusMultiple');
    Route::delete('/actions', [AjaxDashboardController::class, 'deleteMultiple'])->name('ajax.dashboard.deleteMultiple');

    Route::delete('/deleteItem', [AjaxDashboardController::class, 'deleteItem'])->name('ajax.dashboard.deleteItem');

});



Route::get('/admin', [AuthController::class, 'index'])->name('auth.index')->middleware('unauthenticated');
Route::post('/admin', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
