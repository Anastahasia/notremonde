<?php

use App\Http\Controllers\CircuitController;
use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Route::get('/circuits', [CircuitController::class, "circuit"]) ->name('circuits.index');

Route::post('/circuits', [CircuitController::class, "store"]) ->name('circuits.store');
Route::get('admin/circuits/create', [CircuitController::class, "create"]) ->name('circuits.create');

Route::prefix('gestion')->name('gestion')->group(function(){
    Route::resource('property', \App\Http\Controllers\Gestion\PropertyController::class);
});