<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//users
Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/get-product', [HomeController::class, 'getProduct'])->name('home.getproduct');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [ProductController::class, 'index'])->name('admin.home');
    
    Route::get('product/getdata', [ProductController::class, 'getdata'])->name('product.getdata');
    Route::get('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::resource('product',ProductController::class);

});