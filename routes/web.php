<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\AdCommentController;

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Client\ReviewController;
use App\Http\Controllers\Admin\AdReviewController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategorysController;
use App\Http\Controllers\Admin\DashbroadController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\Bannerhome1Controller;
use App\Http\Controllers\Admin\BannerHome2Controller;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Client\BillController;
use App\Http\Controllers\Client\PostController      as ClientPostController;
use App\Http\Controllers\Client\OrderController     as ClientOrderController;
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
Route::group(['middleware' => ['role:Quản lý', 'auth']], function () {
    Route::prefix('admin')
        ->as('admin.')
        ->group(function () {
            Route::get('/', [DashbroadController::class, 'index'])->name('dashboard');

            Route::get('/chat', function () {
                return view('admin.chat.index');
            })->name('chat');

            Route::get('project', [ProjectController::class, 'index'])->name('project');
            Route::get('project/{id}', [ProjectController::class, 'edit'])->name('project.edit');
            Route::put('project/{id}', [ProjectController::class, 'update'])->name('project.update');
            Route::resource('category', CategorysController::class);
            Route::resource('user', UserController::class);
            Route::resource('location', LocationController::class);
            Route::get('/export-excel', [UserController::class, 'exportExcel']);
            Route::resource('post', PostController::class);
            Route::resource('voucher', VoucherController::class);

            Route::prefix('slider')->as('slider.')->group(function () {
                Route::get('/', [BannerController::class, 'index'])->name('index');
                Route::get('/create', [BannerController::class, 'create'])->name('create');
                Route::post('/store', [BannerController::class, 'store'])->name('store');
                Route::get('{id}/edit', [BannerController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [BannerController::class, 'update'])->name('update');
                Route::delete('{id}', [BannerController::class, 'destroy'])->name('destroy');

                // Route::prefix('banner1')->as('banner1.')->group(function () {
                //     Route::get('/', [Bannerhome1Controller::class, 'index'])->name('index');
                //     Route::get('/create', [Bannerhome1Controller::class, 'create'])->name('create');
                //     Route::post('/store', [Bannerhome1Controller::class, 'store'])->name('store');
                //     Route::get('{id}/edit', [Bannerhome1Controller::class, 'edit'])->name('edit');
                //     Route::put('{id}/update', [Bannerhome1Controller::class, 'update'])->name('update');
                //     Route::delete('{id}', [Bannerhome1Controller::class, 'destroy'])->name('destroy');
                // });

                // Route::prefix('banner2')->as('banner2.')->group(function () {
                //     Route::get('/', [BannerHome2Controller::class, 'index'])->name('index');
                //     Route::get('/create', [BannerHome2Controller::class, 'create'])->name('create');
                //     Route::post('/store', [BannerHome2Controller::class, 'store'])->name('store');
                //     Route::get('{id}/edit', [BannerHome2Controller::class, 'edit'])->name('edit');
                //     Route::put('{id}/update', [BannerHome2Controller::class, 'update'])->name('update');
                //     Route::delete('{id}', [BannerHome2Controller::class, 'destroy'])->name('destroy');
                // });
            });

            // Route cho products
            Route::prefix('products')->as('products.')->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::get('/create', [ProductController::class, 'create'])->name('create');
                Route::post('/store', [ProductController::class, 'store'])->name('store');
                Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [ProductController::class, 'update'])->name('update');
                Route::delete('{id}/delete', [ProductController::class, 'delete'])->name('delete');
                Route::get('filter', [ProductController::class, 'filter'])->name('filter');


                // Route cho variants
                Route::prefix('variants')->as('variants.')->group(function () {
                    Route::get('', [ProductVariantController::class, 'index'])->name('index');
                    Route::get('{id}/detail', [ProductVariantController::class, 'detail'])->name('detail');
                    Route::get('{id}/edit', [ProductVariantController::class, 'edit'])->name('edit');
                    Route::get('{product_id}/create', [ProductVariantController::class, 'create'])->name('create');
                    Route::post('/store', [ProductVariantController::class, 'store'])->name('store');
                    Route::put('{id}/update', [ProductVariantController::class, 'update'])->name('update');
                    Route::delete('{id}/delete', [ProductVariantController::class, 'delete'])->name('delete');
                    Route::get('/search', [ProductVariantController::class, 'search'])->name('search');

                    
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
                // Route::put('/{id}/confirm-processing', [OrderController::class, 'confirmProcessing'])->name('confirmProcessing');
            });

            // Route quản lý tồn kho 
            Route::prefix('inventories')->as('inventories.')->group(function () {
                Route::get('/', [InventoryController::class, 'index'])->name('index');
            });

            //Route quản lý đánh giá
            Route::prefix('reviews')->as('reviews.')->group(function () {
                Route::get('/', [AdReviewController::class, 'index'])->name('index');
                Route::delete('/{id}', [AdReviewController::class, 'destroy'])->name('destroy');
                // Route::post('/{review}/toggle', [AdReviewController::class, 'toggleVisibility'])->name('toggle');
            });

            //Route quản lý bộ ảnh sản phẩm
            Route::prefix('images')->as('images.')->group(function () {
                Route::get('/', [ImageController::class, 'viewImage'])->name('index');
            });
            //Route quản lý bình luận bài đăng
            Route::prefix('comments')->as('comments.')->group(function () {
                Route::get('/', [AdCommentController::class, 'index'])->name('index');
                Route::put('/{id}/update', [AdCommentController::class, 'update'])->name('update');
                Route::delete('/{id}', [AdCommentController::class, 'destroy'])->name('destroy');
            });

        });
});

//Route cho máy khách (client)
Route::name('client.')->group(function () {
    Route::get('/',         [HomeController::class, 'index'])->name('home');
    Route::get('/header',   [HomeController::class, 'header'])->name('header');
    Route::resource('voucher', App\Http\Controllers\Client\VoucherController::class);
    Route::get('wave-voucher', [App\Http\Controllers\client\WareController::class, 'wareList'])->name('wave-voucher');
    Route::get('contact', [ContactController::class, 'index'])->name('contact');
    Route::post('send-contact', [ContactController::class, 'store'])->name('sendContact');

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
            Route::get('/', 'index')->name('index');
            Route::get('/{post_show}', 'show')->name('show');
        });

    // Route xóa bình luận
    Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy')
        ->middleware('auth');

    // Route hiển thị bình luận
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])
        ->name('comments.store')
        ->middleware('auth');

    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('client.comments.destroy');

    // Route để gửi đánh giá sản phẩm
    Route::post('/orders/{orderId}/products/{productId}/review', [ReviewController::class, 'submitReview'])
        ->name('orders.product.review')
        ->middleware('auth'); // Chỉ cho phép người dùng đã đăng nhập

    Route::get('/products/{productId}/reviews', [ReviewController::class, 'getReviews'])
        ->name('products.reviews');

    // Route cho trang sản phẩm đã bình luận
    Route::get('/products/{productId}', [ReviewController::class, 'showReviewPage'])
        ->name('product.review.page');

    // Route cho giỏ hàng (cart)
    Route::prefix('carts')
        ->middleware(['convert.cart'])
        ->controller(CartController::class)
        ->name('carts.')
        ->group(
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/cart', 'cart')->name('cart');
                Route::get('/get', 'getCart')->name('get');
                Route::post('/add', 'addToCart')->name('add');
                Route::put('/{id}', 'updateCart')->name('update');
                Route::delete('/{id}', 'destroy')->name('delete');
            }
        );
    // Route::get('/shipping/address-level4', [ShippingController::class, 'getAddressLevel4']);
});

// Route cho khách hàng (client)
Route::group(['middleware' => ['role:Khách hàng', 'auth']], function () {
    Route::resource('profile', ProfileController::class);

    Route::get('checkout', [PaymentController::class, 'showPaymentForm'])->middleware('checkOrderStatus')->name('checkout'); // Hiển thị form thanh toán
    Route::post('checkout', [PaymentController::class, 'checkout'])->name('checkout.process'); // Xử lý thanh toán
    Route::get('payment-momo', [PaymentController::class, 'paymentMomo'])->name('payment.momo');
    Route::post('/momo/ipn', [PaymentController::class, 'handleMoMoIPN'])->name('payment.momo.notify');
    Route::get('/momo/return', [PaymentController::class, 'handleMoMoReturn'])->name('payment.momo.return');

    Route::get('payment-success', [PaymentController::class, 'paymentSuccessForUser'])->name('payment.success'); // Trang thành công
    // Trang thành công
    Route::post('processVoucher', [PaymentController::class, 'processVoucher'])->name('processVoucher');
    // Route hiển thị đơn hàng
    Route::get('/orders', [ClientOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [ClientOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/update', [ClientOrderController::class, 'update'])->name('orders.update');
    Route::get('/orders/{id}/status', [ClientOrderController::class, 'getOrderStatus'])->name('orders.getStatus');
});
// Route cho thanh toán khách vãng lai
Route::prefix('guest')->name('guest.')->group(function () {
    // Hiển thị form thanh toán cho khách vãng lai
    Route::get('checkout', [PaymentController::class, 'showGuestPaymentForm'])
        ->name('checkout')
        ->middleware('guest');  // Đảm bảo khách chưa đăng nhập
    // Xử lý thanh toán cho khách vãng lai
    Route::post('checkout', [PaymentController::class, 'guestCheckout'])
        ->name('checkout.process')
        ->middleware('guest');  // Middleware dành cho khách chưa đăng nhập


    // Trang xác nhận thanh toán thành công cho khách vãng lai
    Route::get('payment-guest-success', [PaymentController::class, 'paymentSuccessForGuest'])
        ->name('payment.success')
        ->middleware('guest');

    // Giỏ hàng của khách vãng lai
    Route::prefix('carts')
        ->middleware(['guest', 'convert.cart'])  // Middleware khách vãng lai và chuyển đổi giỏ hàng
        ->controller(CartController::class)
        ->name('carts.')
        ->group(function () {
            Route::get('/', 'index')->name('index');  // Hiển thị giỏ hàng
            Route::get('/get', 'getCart')->name('get');  // Lấy giỏ hàng
            Route::post('/add', 'addToCart')->name('add');  // Thêm sản phẩm vào giỏ
            Route::put('/{id}', 'updateCart')->name('update');  // Cập nhật giỏ hàng
            Route::delete('/{id}', 'destroy')->name('delete');  // Xóa sản phẩm khỏi giỏ
        });
});

// Route cho xác thực
Route::get('register', [AuthController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('register', [AuthController::class, 'register'])->middleware('guest');

Route::get('login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::post('loginAjax', [AuthController::class, 'loginAjax'])->name('loginAjax')->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('password/reset', [AuthController::class, 'showResetPasswordForm'])->middleware('guest')->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLink'])->middleware('guest')->name('password.email');

Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');

// Route api cho chat
Route::get('/chat-room-id', [ChatController::class, 'fetchChatRoomId']);
Route::post('/send-message', [ChatController::class, 'sendMessage']);

Route::get('/api/chat-room', [ChatController::class, 'fetchChatRooms']);
Route::post('/api/block-user', [ChatController::class, 'blockUser']);
Route::post('/api/unblock-user', [ChatController::class, 'unblockUser']);

Route::get('/api/messages/{chatRoomId}', [ChatController::class, 'fetchMessages']);
Route::post('/api/messages/{chatRoomId}', [ChatController::class, 'markAsRead']);

// Hiển thị form tìm kiếm hóa đơn
Route::get('/client/search-bill', [BillController::class, 'showSearchPage'])->name('search.bill');

// Xử lý tìm kiếm hóa đơn
Route::post('/client/search-bill', [BillController::class, 'searchBill'])->name('search.bill.post');
Route::get('/search/{orderId}/bill', [BillController::class, 'showBill'])->name('search.showBill');

//Hiển thị form tìm kiếm sản phảm
Route::get('/SearchPro', [ClientProductController::class, 'search'])->name('products.SearchPro');
