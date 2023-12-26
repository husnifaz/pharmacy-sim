<?php

use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MedicineUsesController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UnitMedicinesController;
use App\Http\Controllers\UserController;
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
    return redirect()->route('menu.index');
});

Route::get('/home', function () {
    return redirect()->route('menu.index');
});

Route::middleware(['verified:login', 'permission'])->group(function () {
    Route::resource('menu', MenuController::class);
    Route::resource('employee', EmployeesController::class);
    Route::resource('user', UserController::class);

    Route::resource('item', ItemController::class);

    Route::resource('unit-medicine', UnitMedicinesController::class);
    Route::get('dropdown/med-unit', [UnitMedicinesController::class, 'dropdown'])->name('unit-medicine.dropdown');

    Route::resource('medicine-use', MedicineUsesController::class);

    Route::prefix('order')->group(function () {
        Route::get('create', [OrderController::class, 'create'])->name('order.create');
        Route::post('store', [OrderController::class, 'store'])->name('order.store');
        Route::post('update', [OrderController::class, 'update'])->name('order.update');
        Route::get('edit', [OrderController::class, 'edit'])->name('order.edit');
        Route::get('list-item', [OrderController::class, 'listItem'])->name('order.list-item');
        Route::post('store-detail', [OrderController::class, 'storeDetail'])->name('order.store-detail');
    });
});
