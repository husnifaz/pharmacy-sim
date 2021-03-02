<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\PegawaiController;
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
    return redirect()->route('indexMenu');
});

Route::get('/home', function () {
    return redirect()->route('indexMenu');
});

Route::middleware(['verified:login', 'permission'])->group(function() {
    Route::prefix('menu')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('indexMenu');
        Route::get('/form', [MenuController::class, 'form']);
        Route::post('/store', [MenuController::class, 'store']);
        Route::get('edit/{id}', [MenuController::class, 'edit']);
        Route::post('update/{id}', [MenuController::class, 'update']);
        Route::get('delete/{id}', [MenuController::class, 'delete']);
    });

    Route::resource('pegawai', PegawaiController::class);
});

