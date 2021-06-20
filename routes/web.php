<?php

use App\Http\Controllers\CustomerController;
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
});
