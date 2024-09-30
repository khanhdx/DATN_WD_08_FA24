<?php

use App\Http\Controllers\Admin\CategorysController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\AuthController;
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
Route::resource('category', CategorysController::class);

Route::resource('user', UserController::class);
Route::resource('posts', PostController::class);


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product_detail/{product}', [HomeController::class, 'product_detail'])->name('client.product_detail');

Route::get('/posts', [HomeController::class, 'posts'])->name('client.posts');
Route::get('/post_show/{id}', [HomeController::class, 'post_show'])->name('client.post_show');

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('password/reset', [AuthController::class, 'showResetPasswordForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');


Route::prefix('admins')
    // middlware check auth and admin
    ->as('admin.')
    ->group(function () {

        Route::prefix('colors')
            ->as('colors.')
            ->group(function () {
                Route::get('/', [ColorController::class, 'index'])->name('index');
                // Route::get('/create', [ColorController::class, 'create'])->name('create');
                Route::post('/store', [ColorController::class, 'store'])->name('store');
                // Route::get('/show/{id}', [ColorController::class, 'show'])->name('show');
                // Route::get('{id}/edit', [ColorController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [ColorController::class, 'update'])->name('update');
                Route::delete('{id}/delete', [ColorController::class, 'delete'])->name('delete');
            });

        Route::prefix('sizes')
            ->as('sizes.')
            ->group(function () {
                Route::get('/', [SizeController::class, 'index'])->name('index');
                // Route::get('/create', [SizeController::class, 'create'])->name('create');
                Route::post('/store', [SizeController::class, 'store'])->name('store');
                // Route::get('/show/{id}', [SizeController::class, 'show'])->name('show');
                // Route::get('{id}/edit', [SizeController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [SizeController::class, 'update'])->name('update');
                Route::delete('{id}/delete', [SizeController::class, 'delete'])->name('delete');
            });

            Route::prefix('products')
            ->as('products.')
            ->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                // Route::get('/create', [ProductController::class, 'create'])->name('create');
                Route::post('/store', [ProductController::class, 'store'])->name('store');
                // Route::get('/show/{id}', [ProductController::class, 'show'])->name('show');
                // Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [ProductController::class, 'update'])->name('update');
                Route::delete('{id}/delete', [ProductController::class, 'delete'])->name('delete');

                Route::prefix('variants')
                ->as('variants.')
                ->group(function () {
                    Route::get('/', [ProductVariantController::class, 'index'])->name('index');
                    // Route::get('/create', [ProductVariantController::class, 'create'])->name('create');
                    Route::post('/store', [ProductVariantController::class, 'store'])->name('store');
                    // Route::get('/show/{id}', [ProductVariantController::class, 'show'])->name('show');
                    // Route::get('{id}/edit', [ProductVariantController::class, 'edit'])->name('edit');
                    Route::put('{id}/update', [ProductVariantController::class, 'update'])->name('update');
                    Route::delete('{id}/delete', [ProductVariantController::class, 'delete'])->name('delete');
                });
            });

    });
