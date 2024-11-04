<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

Route::get('/product/{product}', [ProductController::class, 'show_modal'])->name('product.show');

Route::get('/get-color', [ProductController::class, 'getColor'])->name('get.color');
Route::get('/get-stock', [ProductController::class, 'getInStock'])->name('get.stock');


// Route cho giao hàng nhanh
Route::get('/provinces', [ShippingController::class, 'getProvinces']);
Route::get('/districts', [ShippingController::class, 'getDistricts']);
Route::post('/calculate-shipping-fee', [ShippingController::class, 'calculateShippingFee']);
Route::post('/create-order', [ShippingController::class, 'createOrder']);
// Route::middleware('auth')->group(function () {
//     Route::get('/provinces', [ShippingController::class, 'getProvinces']);
//     Route::get('/districts', [ShippingController::class, 'getDistricts']);
//     Route::post('/calculate-shipping-fee', [ShippingController::class, 'calculateShippingFee']);
//     Route::post('/create-order', [ShippingController::class, 'createOrder']);
// });