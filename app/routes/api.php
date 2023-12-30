<?php

use App\Http\Controllers\CodeController;
use App\Http\Controllers\SalesmanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/**
 * Salesmen
 */
Route::prefix('salesmen')->name('salesmen.')->group(function () {
    Route::get('/', [SalesmanController::class, 'index'])->name('index');
    Route::post('/', [SalesmanController::class, 'store'])->name('store');
    Route::get('/{salesman:id}', [SalesmanController::class, 'show'])
        ->whereUuid('id')
        ->name('show');
    Route::put('/{salesman:id}', [SalesmanController::class, 'update'])
        ->whereUuid('id')
        ->name('update');
    Route::delete('/{salesman:id}', [SalesmanController::class, 'destroy'])
        ->whereUuid('id')
        ->name('destroy');
});

/**
 * Codelists
 */
Route::prefix('codelists')->group(function () {
    Route::get('/', [CodeController::class, 'index']);
});
