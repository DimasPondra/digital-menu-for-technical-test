<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'loginPage'])->name('login-page');
    Route::post('login', [AuthController::class, 'authenticate'])->name('login-process');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Category
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::patch('{category}/update', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('{category}/delete', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
    });

    // Product
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::patch('{product}/update', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('{product}/delete', [ProductController::class, 'destroy'])->name('admin.products.delete');

        Route::patch('{product}/change-status', [ProductController::class, 'changeStatus'])->name('admin.products.change-status');
    });
});
