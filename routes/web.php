<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PostController;
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
    return view('admin.admins');
});

Route::resource('user', UserController::class);
Route::resource('posts', PostController::class);


Route::get('/', [HomeController::class, 'index']);

// Route để hiển thị danh sách bài viết
Route::get('/posts', [PostController::class, 'clientIndex'])->name('client.posts.index');

// Route để hiển thị chi tiết từng bài viết
Route::get('/posts/{id}', [PostController::class, 'clientShow'])->name('client.posts.show');
