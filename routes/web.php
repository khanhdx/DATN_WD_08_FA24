<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\PostController;
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

Route::get('/admin', function () {
    return view('admin.admin');
});

Route::resource('user', UserController::class);
Route::resource('posts', PostController::class);


Route::get('/', [HomeController::class, 'index']);

Route::get('/product_detail/{product}', [HomeController::class, 'product_detail'])->name('client.product_detail');

Route::get('/posts', [HomeController::class, 'posts'])->name('client.posts');

Route::get('/post_show/{id}', [HomeController::class, 'post_show'])->name('client.post_show');
