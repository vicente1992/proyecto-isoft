<?php
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('product', 'SalesController@getProducts');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->group(function () {
    Route::get('product', [SalesController::class, 'getProducts']);
    Route::post('sales', [SalesController::class, 'store']);
    Route::get('sales', [SalesController::class, 'index']);
    Route::get('sales/list', [SalesController::class, 'getSales']);
    Route::post('order', [SalesController::class, 'crateOrder']);
    Route::put('product/{id}', [SalesController::class, 'updateProduct']);
    Route::post('reports', [SalesReportController::class, 'store']);
});