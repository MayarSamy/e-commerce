<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect('login');
});

Route::get('/home', [App\Http\Controllers\ProductController::class, 'index'])->name('home');
Route::get('add/{id}', [App\Http\Controllers\ProductController::class, 'addToCart']);
Route::delete('remove', [App\Http\Controllers\ProductController::class, 'remove']);
Route::get('/get-products', [App\Http\Controllers\ProductController::class, 'getProudcts'])->name('get-products');

Route::resource('orders', App\Http\Controllers\OrderController::class);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
