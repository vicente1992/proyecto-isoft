<?php

use App\Http\Controllers\BillsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\userController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesReportController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('user', userController::class);
//  Route::resource('product/list', [ProductController::class, 'getProducts']);
Route::resource('product', ProductController::class);
Route::resource('bills', BillsController::class);
Route::resource('sales', SalesController::class);
Route::resource('reports', SalesReportController::class);
