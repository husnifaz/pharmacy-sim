<?php

use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemStockController;
use App\Http\Controllers\MedicineUsesController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\MedicineUnitController;
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

    Route::resource('medicine-unit', MedicineUnitController::class);
    Route::get('medicine-unit-dropdown', [MedicineUnitController::class, 'dropdown'])->name('medicine-unit.dropdown');

    Route::resource('medicine-use', MedicineUsesController::class);

    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::get('create', [OrderController::class, 'create'])->name('order.create');
        Route::post('store', [OrderController::class, 'store'])->name('order.store');
        Route::get('show', [OrderController::class, 'show'])->name('order.show');
        Route::post('update', [OrderController::class, 'update'])->name('order.update');
        Route::get('edit', [OrderController::class, 'edit'])->name('order.edit');
        Route::post('destroy', [OrderController::class, 'destroy'])->name('order.destroy');
        Route::get('list-item', [OrderController::class, 'listItem'])->name('order.list-item');
        Route::post('store-detail', [OrderController::class, 'storeDetail'])->name('order.store-detail');
        Route::post('delete-child', [OrderController::class, 'deleteChild'])->name('order.delete-child');
        Route::post('finish-order', [OrderController::class, 'finishOrder'])->name('order.finish-order');
    });

    Route::prefix('prescription')->group(function () {
        Route::get('/', [PrescriptionController::class, 'index'])->name('prescription.index');
        Route::get('create', [PrescriptionController::class, 'create'])->name('prescription.create');
        Route::post('store', [PrescriptionController::class, 'store'])->name('prescription.store');
        Route::get('show', [PrescriptionController::class, 'show'])->name('prescription.show');
        Route::post('update', [PrescriptionController::class, 'update'])->name('prescription.update');
        Route::get('edit', [PrescriptionController::class, 'edit'])->name('prescription.edit');
        Route::post('destroy', [PrescriptionController::class, 'destroy'])->name('prescription.destroy');
        Route::get('list-item', [PrescriptionController::class, 'listItem'])->name('prescription.list-item');
        Route::get('list-item-stock', [PrescriptionController::class, 'listItemStock'])->name('prescription.list-item-stock');
        Route::get('list-medicine-uses', [PrescriptionController::class, 'listMedicineUses'])->name('prescription.list-medicine-uses');
        Route::post('store-detail', [PrescriptionController::class, 'storeDetail'])->name('prescription.store-detail');
        Route::post('delete-child', [PrescriptionController::class, 'deleteChild'])->name('prescription.delete-child');
        Route::post('finish-prescription', [PrescriptionController::class, 'finishOrder'])->name('prescription.finish-prescription');
    });

    Route::prefix('item-stock')->group(function () {
        Route::get('/', [ItemStockController::class, 'index'])->name('item-stock.index');
        Route::get('show', [ItemStockController::class, 'show'])->name('item-stock.show');
        Route::get('pull', [ItemStockController::class, 'pull'])->name('item-stock.pull');
    });
});
