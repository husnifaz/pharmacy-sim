<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PegawaiController;
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
});
