<div class="container">
    <p class="pull-left text-note">MIỄN PHÍ VẬN CHUYỂN CHO TẤT CẢ CÁC ĐƠN HÀNG TRÊN 4999K</p>
    <ul class="nav nav-pills nav-top navbar-right">

        <li class="dropdown my-account">
            @guest
                <!-- Hiển thị nếu chưa đăng nhập -->
                <li class="login">
                    <a href="#">
                        <i class="fa fa-user"></i> Login
                    </a>
                </li>
            @endguest
            @auth
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ auth()->user()->name }}<span
                        class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    @if (auth()->user()->role == 'Khách hàng')
                        <li><a href="{{ route('profile.index') }}">Trang cá nhân</a></li>
                        <li><a href="{{ route('orders.index') }}">Đơn hàng của tôi</a></li>
                        <li><a href="{{ route('client.wave-voucher') }}">Kho mã giảm giá</a></li>
                    @elseif (auth()->user()->role == 'Quản lý')
                        <li><a href="{{ route('admin.dashboard') }}">Trang Admin</a></li>
                    @endif
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); 
                               document.getElementById('logout-form').submit();">
                            Đăng xuất
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </li>
            </ul>
        @endauth
        </li>
        <li class="dropdown menu-shop">
            <a href="{{ route('client.carts.index') }}" class="dropdown-toggle dropdownLink" data-toggle="dropdown">
                <i class="fa fa-shopping-cart"></i>
                <span class="shopping-bag">{{ Auth::check() ? count($cartItems->toArray()) : count($cartItems) }}</span>
            </a>
            <div class="dropdown-menu">
                <h3>Các sản phẩm được thêm gần đây</h3>
                <ul class="list-unstyled list-thumbs-pro">
                    @foreach ($cartItems as $key => $cart)
                        <li class="product">
                            <div class="product-thumb-info">
                                <form method="post">
                                    @csrf

                                    <a title="Remove this item" class="product-remove remove-cart"
                                        href="{{ route('client.carts.delete', Auth::check() ? $cart->id : $key) }}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </form>
                                <div class="product-thumb-info-image">
                                    <a href="shop-product-detail1.html"><img alt="" width="60"
                                            src="{{ Auth::check() ? $cart->productVariant->product->image : $cart['image'] }}"></a>
                                </div>

                                <div class="product-thumb-info-content">
                                    <h4><a
                                            href="">{{ Auth::check() ? $cart->productVariant->product->name : $cart['name'] }}</a>
                                    </h4>
                                    <span class="item-cat">
                                        <small>
                                            <a
                                                href="#">&times;{{ Auth::check() ? $cart->quantity : $cart['quantity'] }}</a>
                                        </small>
                                    </span>
                                    <span class="item-cat">
                                        <small>
                                            <a href="#">
                                                {{ Auth::check() ? $cart->productVariant->color->name : $cart['color'] }},
                                                {{ Auth::check() ? $cart->productVariant->size->name : $cart['size'] }}
                                            </a>
                                        </small>
                                    </span>
                                    <span
                                        class="price">{{ Auth::check() ? number_format($cart->productVariant->price, 0, ',', '.') : number_format($cart['price'], 0, ',', '.') }}
                                        đ</span>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
                <ul class="list-inline cart-subtotals text-right">
                    <li class="cart-subtotal"><strong>Tổng giá</strong></li>
                    <li class="price"><span class="amount"><strong>{{ number_format($total, 0, ',', '.') }}
                                VND</strong></span>
                    </li>
                </ul>
                <div class="cart-buttons text-right">
                    <a href="{{ route('client.carts.index') }}"><button class="btn btn-white">Xem giỏ hàng</button></a>
                    <a href="{{ route('checkout') }}"><button class="btn btn-primary">Thanh toán</button></a>
                </div>
            </div>
        </li>
    </ul>
</div>
