<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BasketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'basket'], function () {
    Route::controller(BasketController::class)->group(function () {
        Route::get('/', 'index')->name('basket.index');
        Route::post('/add/{code}', 'store')->name('basket.add');
        Route::delete('/basket/{code}', 'destroy')->name('basket.destroy');
        Route::get('/total', 'total')->name('basket.total');
    });
});