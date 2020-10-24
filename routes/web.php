<?php

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
    return view('welcome');
});

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::get('/products/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::post('/products', [\App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::delete('/products/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('product.delete');
Route::get('/products/edit/{product}', [\App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
Route::patch('/products/update/{product}', [\App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
Route::get('/product/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
