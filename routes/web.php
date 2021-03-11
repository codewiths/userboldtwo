<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\ImageController;

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

Auth::routes();
Route::get('', [RoutingController::class,'index'])->name('index');
Route::get('/tables/datatables', [BlogController::class, 'index'])->name('datatables');
Route::get('/tables/create', [BlogController::class, 'create'])->name('tables.create');
Route::post('/tables/create', [BlogController::class, 'store'])->name('tables.store');
Route::get('/tables/edit/{blog}', [BlogController::class, 'edit'])->name('tables.edit');
Route::post('/tables/edit/{blog}', [BlogController::class, 'update'])->name('tables.update');
Route::post('/tables/delete/{blog}', [BlogController::class, 'destroy'])->name('tables.destroy');

Route::group(['middleware' => 'auth', 'prefix' => '/'], function () {
    Route::get('{first}/{second}/{third}', [RoutingController::class,'thirdLevel'])->name('third');
    Route::get('{first}/{second}',[RoutingController::class,'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class,'root'])->name('any');
});

// landing

