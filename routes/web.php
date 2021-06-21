<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CustomerController;
use App\Models\City;
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
    return view('home');
});

Route::prefix('customers')->group(function (){
    Route::get('/' , [CustomerController::class , 'index'])->name('customers.index');
    Route::get('create', [CustomerController::class , 'create'])->name('customers.create');
    Route::post('store', [CustomerController::class , 'store'])->name('customers.store');
    Route::get('/{id}/edit' , [CustomerController::class , 'edit'])->name('customers.edit');
    Route::post('/{id}/update' , [CustomerController::class , 'update'])->name('customers.update');
    Route::get('/{id}/delete' , [CustomerController::class , 'destroy'])->name('customers.delete');
    Route::get('/filterByCity' , [CustomerController::class , 'filterByCity'])->name('customers.filterByCity');
});

Route::prefix('cities')->group(function(){
    Route::get('/' , [CityController::class , 'index'])->name('cities.index');
    Route::get('/create' , [CityController::class , 'create'])->name('cities.create');
    Route::post('/store' , [CityController::class , 'store'])->name('cities.store');
    Route::get('{id}/edit' , [CityController::class , 'edit'])->name('cities.edit');
    Route::post('{id}/update' , [CityController::class , 'update'])->name('cities.update');
    Route::get('{id}/delete' , [CityController::class , 'delete'])->name('cities.destroy');
});
