@php
    use App\Models\Category;

    $categories = Category::query()->get();
@endphp

<nav class="navbar navbar-default navbar-main navbar-main-slide" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span
                    class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                <span class="icon-bar"></span> </button>
            <a class="logo" href="/"><img src="/assets/client/images/logo.png" alt="Flatize"></a>
        </div>
        <ul class="nav navbar-nav navbar-act pull-right">
            <li class="login">
                @guest
                    <!-- Hiển thị nếu chưa đăng nhập -->
                    <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                @endguest

                @auth
                    <!-- Hiển thị nếu đã đăng nhập với dropdown -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> {{ auth()->user()->name }} <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        @if (auth()->user()->role == 'Khách hàng')
                            <li><a href="{{ route('profile.index') }}">Trang cá nhân</a></li>
                        @elseif (auth()->user()->role == 'Quản lý')
                            <li><a href="{{ route('admin.dashboard') }}">Trang Admin</a></li>
                        @endif
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); 
                                   document.getElementById('logout-form').submit();">
                                Logout form
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @endauth
            </li>

            <li class="search"><a href="javascript:void(0);" data-toggle="modal" data-target=".bs-example-modal-lg"><i
                        class="fa fa-search"></i></a></li>
        </ul>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right">
                {{-- <li><a href="/">Home</a></li> --}}

                <li class="dropdown megamenu">
                    <a href="{{ route('client.product.index') }}" class="dropdown-toggle dropdownLink"
                        data-toggle="dropdown">Shop
                    </a>
                    <div class="dropdown-menu">
                        <div class="mega-menu-content">
                            <div class="row">
                                <div class="col-md-4 hidden-sm hidden-xs menu-column">
                                    <h3>Trends</h3>
                                    <ul class="list-unstyled sub-menu list-thumbs-pro">
                                        <li class="product">
                                            <div class="product-thumb-info">
                                                <div class="product-thumb-info-image">
                                                    <a href="shop-product-detail1.html"><img alt=""
                                                            width="60"
                                                            src="/assets/client/images/content/products/product-1.jpg"></a>
                                                </div>

                                                <div class="product-thumb-info-content">
                                                    <h4><a href="shop-product-detail2.html">Denim shirt</a></h4>
                                                    <span class="item-cat"><small><a
                                                                href="#">Jackets</a></small></span>
                                                    <span class="price">29.99 USD</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product">
                                            <div class="product-thumb-info">
                                                <div class="product-thumb-info-image">
                                                    <a href="shop-product-detail1.html"><img alt=""
                                                            width="60"
                                                            src="/assets/client/images/content/products/product-2.jpg"></a>
                                                </div>

                                                <div class="product-thumb-info-content">
                                                    <h4><a href="shop-product-detail2.html">Poplin shirt with fine
                                                            pleated bands</a></h4>
                                                    <span class="item-cat"><small><a
                                                                href="#">Jackets</a></small></span>
                                                    <span class="price">29.99 USD</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product">
                                            <div class="product-thumb-info">
                                                <div class="product-thumb-info-image">
                                                    <a href="shop-product-detail1.html"><img alt=""
                                                            width="60"
                                                            src="/assets/client/images/content/products/product-3.jpg"></a>
                                                </div>

                                                <div class="product-thumb-info-content">
                                                    <h4><a href="shop-product-detail2.html">Contrasting shirt</a></h4>
                                                    <span class="item-cat"><small><a
                                                                href="#">Jackets</a></small></span>
                                                    <span class="price">29.99 USD</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-2 menu-column">
                                    <h3>Man</h3>
                                    <ul class="list-unstyled sub-menu">
                                        @foreach ($categories as $item)
                                            @if ($item->type == 'Man')
                                                <li><a href="#">{{ $item->name }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-2 menu-column">
                                    <h3>Woman</h3>
                                    <ul class="list-unstyled sub-menu">
                                        @foreach ($categories as $item)
                                            @if ($item->type == 'Woman')
                                                <li><a href="#">{{ $item->name }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-4 hidden-sm hidden-xs menu-column">
                                    <h3>Explore new collection</h3>
                                    <ul class="list-unstyled sub-menu list-md-pro">
                                        <li class="product">
                                            <div class="product-thumb-info">
                                                <div class="product-thumb-info-image">
                                                    <a href="shop-product-detail1.html"><img class="img-responsive"
                                                            width="330" alt=""
                                                            src="/assets/client/images/content/products/ad-1.png"></a>
                                                </div>

                                                <div class="product-thumb-info-content">
                                                    <h4><a href="shop-product-detail2.html">Men’s Fashion and Style</a>
                                                    </h4>
                                                    <p>Whatever you’re looking for, be it the latest fashion trends,
                                                        cool outfit ideas or new ways to wear your favourite pieces,
                                                        we’ve got all the style inspiration you need.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li><a href="{{ route('client.post.index') }}">Blog</a></li>
                <li><a href="{{ route('client.contact') }}">Contact</a></li>
                <li><a href="{{ route('client.voucher.index') }}">Voucher</a></li>
            </ul>
        </div>
    </div>
</nav>
