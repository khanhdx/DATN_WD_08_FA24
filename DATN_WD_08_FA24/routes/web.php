<?php

use App\Http\Controllers\Admins\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
    return view('layouts.admins');
});




Route::resource('user', UserController::class);
Route::resource('posts', PostController::class);


// Route để hiển thị danh sách bài viết cho client
Route::get('/client/posts', [PostController::class, 'clientIndex'])->name('client.posts.index');

// Route để hiển thị chi tiết từng bài viết
Route::get('/client/posts/{id}', [PostController::class, 'clientShow'])->name('client.posts.show');
