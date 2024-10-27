<?php

use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/get-size', [ProductController::class, 'getSize'])->name('get.size');
Route::get('/get-color', [ProductController::class, 'getColor'])->name('get.color');
