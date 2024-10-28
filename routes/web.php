<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategorysController;
use App\Http\Controllers\Admin\DashbroadController;
use App\Http\Controllers\Admin\Bannerhome1Controller;
use App\Http\Controllers\Admin\BannerHome2Controller;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Client\PostController      as ClientPostController;
use App\Http\Controllers\Client\ProductController   as ClientProductController;

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

Route::get('test', function () {
    return view('admin.products.abcd');
});

// Route cho quản lý (admin)
Route::group(['middleware' => ['role:Quản lý']], function () {
    Route::get('/admin', [DashbroadController::class, 'index'])->name('admin.dashboard');

    Route::prefix('admins')
        ->as('admin.')
        ->group(function () {
            Route::resource('category', CategorysController::class);
            // Route::resource('slider', BannerController::class);
            Route::resource('user', App\Http\Controllers\Admin\UserController::class);
            Route::resource('location', App\Http\Controllers\Admin\LocationController::class);
            Route::get('/export-excel', [App\Http\Controllers\Admin\UserController::class, 'exportExcel']);
            Route::resource('post', PostController::class);
            Route::resource('voucher', App\Http\Controllers\Admin\VoucherController::class);

            Route::prefix('slider')->as('slider.')->group(function () {
                Route::get('/', [BannerController::class, 'index'])->name('index');
                Route::get('/create', [BannerController::class, 'create'])->name('create');
                Route::post('/store', [BannerController::class, 'store'])->name('store');
                Route::get('{id}/edit', [BannerController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [BannerController::class, 'update'])->name('update');
                Route::delete('{id}', [BannerController::class, 'destroy'])->name('destroy');
            
               
                Route::prefix('banner1')->as('banner1.')->group(function () {
                    Route::get('/', [Bannerhome1Controller::class, 'index'])->name('index');
                    Route::get('/create', [Bannerhome1Controller::class, 'create'])->name('create');
                    Route::post('/store', [Bannerhome1Controller::class, 'store'])->name('store');
                    Route::get('{id}/edit', [Bannerhome1Controller::class, 'edit'])->name('edit');
                    Route::put('{id}/update', [Bannerhome1Controller::class, 'update'])->name('update');
                    Route::delete('{id}', [Bannerhome1Controller::class, 'destroy'])->name('destroy');
                });

                Route::prefix('banner2')->as('banner2.')->group(function () {
                    Route::get('/', [BannerHome2Controller::class, 'index'])->name('index');
                    Route::get('/create', [BannerHome2Controller::class, 'create'])->name('create');
                    Route::post('/store', [BannerHome2Controller::class, 'store'])->name('store');
                    Route::get('{id}/edit', [BannerHome2Controller::class, 'edit'])->name('edit');
                    Route::put('{id}/update', [BannerHome2Controller::class, 'update'])->name('update');
                    Route::delete('{id}', [BannerHome2Controller::class, 'destroy'])->name('destroy');
                });
            });

            // Route cho products
            Route::prefix('products')->as('products.')->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::get('/create', [ProductController::class, 'create'])->name('create');
                Route::post('/store', [ProductController::class, 'store'])->name('store');
                Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [ProductController::class, 'update'])->name('update');
                Route::delete('{id}/delete', [ProductController::class, 'delete'])->name('delete');



                // Route cho variants
                Route::prefix('variants')->as('variants.')->group(function () {
                    Route::get('/', [ProductVariantController::class, 'index'])->name('index');
                    Route::get('{id}/detail', [ProductVariantController::class, 'detail'])->name('detail');
                    Route::get('{id}/edit', [ProductVariantController::class, 'edit'])->name('edit');
                    Route::get('{product_id}/create', [ProductVariantController::class, 'create'])->name('create');
                    Route::post('/store', [ProductVariantController::class, 'store'])->name('store');
                    Route::put('{id}/update', [ProductVariantController::class, 'update'])->name('update');
                    Route::delete('{id}/delete', [ProductVariantController::class, 'delete'])->name('delete');

                    Route::get('get-all-atributes', [ProductVariantController::class, 'getAllAttribute'])->name('getAllAttribute');

                    // Route cho colors
                    Route::prefix('colors')->as('colors.')->group(function () {
                        Route::post('/store', [ColorController::class, 'store'])->name('store');
                        Route::put('{id}/update', [ColorController::class, 'update'])->name('update');
                        Route::delete('{id}/delete', [ColorController::class, 'delete'])->name('delete');
                    });

                    // Route cho sizes
                    Route::prefix('sizes')->as('sizes.')->group(function () {
                        Route::post('/store', [SizeController::class, 'store'])->name('store');
                        Route::put('{id}/update', [SizeController::class, 'update'])->name('update');
                        Route::delete('{id}/delete', [SizeController::class, 'delete'])->name('delete');
                    });
                });
            });

            // Route quản lý orders
            Route::prefix('orders')->as('orders.')->group(function () {
                Route::get('/', [OrderController::class, 'index'])->name('index');
                Route::get('/show/{id}', [OrderController::class, 'show'])->name('show');
                Route::put('/{id}/update-status', [OrderController::class, 'updateStatus'])->name('updateStatus');
            });
        });
});

//Route cho máy khách (client)
Route::name('client.')->group(function () {
    Route::get('/',         [HomeController::class, 'index'])->name('home');
    Route::get('/contact',  [HomeController::class, 'contact'])->name('contact');
    Route::get('/header',  [HomeController::class, 'header'])->name('header');
    Route::resource('voucher', App\Http\Controllers\Client\VoucherController::class);
    
    // Route cho sản phẩm (product)
    Route::prefix('products')
        ->controller(ClientProductController::class)
        ->name('product.')
        ->group(function () {
            Route::get('/',          'index')->name('index');
            Route::get('/{product}', 'show')->name('show');
        });

    // Route cho bài viết (post)
    Route::prefix('posts')
        ->controller(ClientPostController::class)
        ->name('post.')
        ->group(function () {
            Route::get('/',       'index')->name('index');
            Route::get('/{post_show}', 'show')->name('show');
        });

    // Route xóa bình luận
    Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy')
        ->middleware('auth');

    // Route hiển thị bình luận
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('client.comments.destroy');
    

    // Route cho giỏ hàng (cart)
    Route::prefix('carts')
        ->middleware(['convert.cart'])
        ->controller(CartController::class)
        ->name('carts.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cart', 'cart')->name('cart');
            Route::get('/get', 'getCart')->name('get');
            Route::post('/add', 'addToCart')->name('add');
            Route::put('/{id}', 'updateCart')->name('update');
            Route::delete('/{id}', 'destroy')->name('delete');
        });
});

// Route cho khách hàng (client)
Route::group(['middleware' => ['role:Khách hàng']], function () {
    Route::resource('profile', ProfileController::class)->only([
        'index',
        'edit',
        'update',
        'destroy'
    ]);
    Route::get('checkout', [PaymentController::class, 'showPaymentForm'])->name('checkout'); // Hiển thị form thanh toán
    Route::post('checkout', [PaymentController::class, 'checkout'])->name('checkout.process'); // Xử lý thanh toán
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success'); // Trang thành công
    Route::post('/apply-voucher', [PaymentController::class, 'applyVoucher'])->name('voucher.apply');
    // Route hiển thị đơn hàng
    Route::get('/orders', [ClientOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [ClientOrderController::class, 'show'])->name('orders.show');
});

// Route cho xác thực
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('password/reset', [AuthController::class, 'showResetPasswordForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');