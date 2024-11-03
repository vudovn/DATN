<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\AttributeCategoryController;
use App\Http\Controllers\Admin\CollectionController;

use App\Http\Controllers\Ajax\AjaxController as AjaxDashboardController;
use App\Http\Controllers\Ajax\LocationController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware(['authenticated', 'preventBackHistory'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    /* USER ROUTE */
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/{type}', [UserController::class, 'index'])->name('index')
            ->where('type', 'customer|staff');
        Route::get('/create/{type}', [UserController::class, 'create'])
            ->name('create')->where('type', 'customer|staff');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');

        // Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/api/wards/{district_code}', [UserController::class, 'getWards'])->name('wards');
    });
    /* PRODUCT ROUTE */
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/index', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
    });

    /* ATTRIBUTE ROUTE */
    Route::prefix('attributeCategory')->name('attributeCategory.')->group(function () {
        Route::get('/index', [AttributeCategoryController::class, 'index'])->name('index');
        Route::get('/create', [AttributeCategoryController::class, 'create'])->name('create');
        Route::post('/store', [AttributeCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AttributeCategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AttributeCategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AttributeCategoryController::class, 'delete'])->name('delete');
    });
    /* PERMISSION ROUTE */
    Route::prefix('permission')->name('permission.')->group(function () {
        Route::get('/index', [PermissionController::class, 'index'])->name('index');
        Route::get('/create', [PermissionController::class, 'create'])->name('create');
        Route::post('/store', [PermissionController::class, 'store'])->name('store');
        Route::get('/edit', [PermissionController::class, 'edit'])->name('edit');
        Route::put('/edit', [PermissionController::class, 'edit'])->name('edit');
        Route::get('/delete/{id}', [PermissionController::class, 'delete'])->name('delete');
    });
    /* ROLE ROUTE */
    Route::prefix('role')->name('role.')->group(function () {
        // Route::get('/index', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
    });

    /* ORDER ROUTE */
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('index', [AdminOrderController::class, 'index'])->name('index');
        Route::get('edit/{id}', [AdminOrderController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [AdminOrderController::class, 'update'])->name('update');
        Route::get('delete/{id}', [AdminOrderController::class, 'delete'])->name('delete');
    });
    /* CATEGORY ROUTE */
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/index', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    });
    Route::prefix('collection')->name('collection.')->group(function () {
        Route::get('/index', [CollectionController::class, 'index'])->name('index');
        Route::get('/create', [CollectionController::class, 'create'])->name('create');
        Route::post('/store', [CollectionController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CollectionController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CollectionController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CollectionController::class, 'delete'])->name('delete');
    });
});

Route::middleware(['checkPermission'])->group(function () {
    Route::prefix('{model}')->name('{model}.')->group(function () {
        Route::get('/getData', [AjaxDashboardController::class, 'getData'])->name('ajax.dashboard.getData');
        Route::put('/actions', [AjaxDashboardController::class, 'updateMultiple'])->name('ajax.dashboard.changeStatusMultiple');
        Route::delete('/actions', [AjaxDashboardController::class, 'deleteMultiple'])->name('ajax.dashboard.deleteMultiple');
        Route::delete('/deleteItem', [AjaxDashboardController::class, 'deleteItem'])->name('ajax.dashboard.deleteItem');
        Route::put('/quickUpdate', [AjaxDashboardController::class, 'updateQuick'])->name('ajax.dashboard.quickUpdate');
        Route::put('/change/status', [AjaxDashboardController::class, 'updateStatus'])->name('ajax.dashboard.updateStatus');
    });
});
Route::prefix('setting/account')->name('setting.account.')->group(function () {
    Route::get('/{type}', [UserController::class, 'getInformation'])->name('index');
    Route::put('/update-{type}', [UserController::class, 'updateInformation'])->name('update');
});

Route::get('/ajax/getLocation', [LocationController::class, 'getLocation'])->name('ajax.getLocation');
Route::get('getProduct', [AjaxDashboardController::class, 'getProduct'])->name('getProduct');

// get attribute value
Route::get('/getAttribute', [AjaxDashboardController::class, 'getAttribute'])->name('ajax.dashboard.getAttribute');
Route::get('ajax/getAttributeValue', [AjaxDashboardController::class, 'getAttributeValue'])->name('ajax.dashboard.getAttributeValue');
Route::get('ajax/loadAttributeValue', [AjaxDashboardController::class, 'loadAttributeValue'])->name('ajax.dashboard.loadAttributeValue');

Route::get('/admin', [AuthController::class, 'index'])->name('auth.index')->middleware('unauthenticated');
Route::post('/admin', [AuthController::class, 'login'])->name('auth.login');
Route::get('/admin/forget-password', [AuthController::class, 'forget'])->name('auth.admin.forget');
Route::get('/admin/change-password', [AuthController::class, 'change'])->name('auth.admin.change');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::get('/order-code', function () {
    return orderCode(7);
});
Route::get('/test', [AjaxDashboardController::class, 'test']);

