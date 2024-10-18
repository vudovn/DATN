<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AttributeCategoryController;
// use App\Http\Controllers\Admin\AttributeValueController;

use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['authenticated','preventBackHistory',/*'checkPermission'*/])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    /* USER ROUTE */
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/index', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        // Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
        // Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    /* PRODUCT ROUTE */
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/index', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        // Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
        // Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    /* ATTRIBUTE ROUTE */
    Route::prefix('product/attribute')->name('product.attribute.')->group(function () {
        Route::get('/index', [AttributeController::class, 'index'])->name('index');
        Route::get('/create', [AttributeController::class, 'create'])->name('create');
        Route::post('/store', [AttributeController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AttributeController::class, 'update'])->name('update');
        // Route::get('/delete/{id}', [AttributeController::class, 'delete'])->name('delete');
        // Route::delete('/destroy/{id}', [AttributeController::class, 'destroy'])->name('destroy');
    });

    /* ATTRIBUTE VALUE ROUTE */
    Route::prefix('product/attribute-value')->name('product.attributeValue.')->group(function () {
        Route::get('/index/{attribute_id}', [AttributeValueController::class, 'index'])->name('index');
        Route::get('/create', [AttributeValueController::class, 'create'])->name('create');
        Route::post('/store', [AttributeValueController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AttributeValueController::class, 'edit'])->name('edit');
        Route::put('/update', [AttributeValueController::class, 'update'])->name('update');
        // Route::get('/delete/{id}', [AttributeValueController::class, 'delete'])->name('delete');
        // Route::delete('/destroy/{id}', [AttributeValueController::class, 'destroy'])->name('destroy');
    });
    /* PERMISSION ROUTE */
    Route::prefix('user/permission')->name('user.permission.')->group(function () {
        Route::get('/index', [PermissionController::class, 'index'])->name('index');
        Route::get('/create', [PermissionController::class, 'create'])->name('create');
        Route::post('/store', [PermissionController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('edit');
        Route::put('/update', [PermissionController::class, 'update'])->name('update');
    });
        /* ROLE ROUTE */
        Route::prefix('user/role')->name('user.role.')->group(function () {
            Route::get('/index', [RoleController::class, 'index'])->name('index');
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/store', [RoleController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
        });
    Route::prefix('product/attribute-category')->name('attributeCategory.')->group(function () {
        Route::get('/index', [AttributeCategoryController::class, 'index'])->name('index');
        Route::get('/create', [AttributeCategoryController::class, 'create'])->name('create');
        Route::post('/store', [AttributeCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AttributeCategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AttributeCategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AttributeCategoryController::class, 'delete'])->name('delete');
        Route::delete('/destroy/{id}', [AttributeCategoryController::class, 'destroy'])->name('destroy');
    });

    // /* ATTRIBUTE VALUE ROUTE */
    // Route::prefix('product/attribute-value')->name('product.attributeValue.')->group(function () {
    //     Route::get('/index/{attribute_id}', [AttributeValueController::class, 'index'])->name('index');
    //     Route::get('/create', [AttributeValueController::class, 'create'])->name('create');
    //     Route::post('/store', [AttributeValueController::class, 'store'])->name('store');
    //     Route::get('/edit/{id}', [AttributeValueController::class, 'edit'])->name('edit');
    //     Route::put('/update', [AttributeValueController::class, 'update'])->name('update');
    //     Route::get('/delete/{id}', [AttributeValueController::class, 'delete'])->name('delete');
    //     Route::delete('/destroy/{id}', [AttributeValueController::class, 'destroy'])->name('destroy');
    // });

    /* AJAX ROUTE */
    Route::put('/change/status', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus');
    Route::put('/actions', [AjaxDashboardController::class, 'changeStatusMultiple'])->name('ajax.dashboard.changeStatusMultiple');
    Route::delete('/actions', [AjaxDashboardController::class, 'deleteMultiple'])->name('ajax.dashboard.deleteMultiple');
    Route::delete('/deleteItem', [AjaxDashboardController::class, 'deleteItem'])->name('ajax.dashboard.deleteItem');
    Route::put('/quickUpdate', [AjaxDashboardController::class, 'quickUpdate'])->name('ajax.dashboard.quickUpdate');

    // get attribute value
    Route::get('/getAttribute', [AjaxDashboardController::class, 'getAttribute'])->name('ajax.dashboard.getAttribute');
    Route::get('ajax/getAttributeValue', [AjaxDashboardController::class, 'getAttributeValue'])->name('ajax.dashboard.getAttributeValue');
    Route::get('ajax/loadAttributeValue', [AjaxDashboardController::class, 'loadAttributeValue'])->name('ajax.dashboard.loadAttributeValue');
});



Route::get('/admin', [AuthController::class, 'index'])->name('auth.index')->middleware('unauthenticated');
Route::post('/admin', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
