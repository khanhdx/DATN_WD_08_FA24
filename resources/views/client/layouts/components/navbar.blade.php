<nav class="navbar navbar-default navbar-main navbar-main-slide" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span
                    class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                <span class="icon-bar"></span> </button>
            <a class="logo" href="index.html"><img src="images/logo.png" alt="Flatize"></a>
        </div>
        <ul class="nav navbar-nav navbar-act pull-right">
            <li class="login">
                @guest
                    <!-- Hiển thị nếu chưa đăng nhập -->
                    <a href="{{ route('login') }}"><i class="fa fa-user"></i> Đăng nhập</a>
                @endguest
            
                @auth
                    <!-- Hiển thị nếu đã đăng nhập với dropdown -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i> Tài khoản <b class="caret"></b>
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
                                   Đăng xuất
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
                <li class="dropdown active"><a href="index-2.html" class="dropdown-toggle"
                        data-toggle="dropdown">Home</a>
                    <ul class="dropdown-menu">
                        <li class="active"><a href="index-2.html">Home</a></li>
                        <!-- <li><a href="index-3.html">Home Version 3</a></li>
                        <li><a href="index-4.html">Home Version 4</a></li> -->
                        <li><a href="shop-list-sidebar.html">Shop List - Sidebar</a></li>
                        <li><a href="shop-sidebar.html">Shop - Sidebar</a></li>
                    </ul>
                </li>
                <li class="dropdown megamenu"><a href="shop-list-sidebar.html" class="dropdown-toggle"
                        data-toggle="dropdown">Shop</a>
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
                                        <li><a href="#">Jackets</a></li>
                                        <li><a href="#">Blazers</a></li>
                                        <li><a href="#">Suits</a></li>
                                        <li><a href="#">Trousers</a></li>
                                        <li><a href="#">Jeans</a></li>
                                        <li><a href="#">Shirts</a></li>
                                        <li><a href="#">Sweatshirts &amp; Hoodies</a></li>
                                        <li><a href="#">Swimwear</a></li>
                                        <li><a href="#">Accessories</a></li>
                                    </ul>
                                </div>

                                <div class="col-md-2 menu-column">
                                    <h3>Woman</h3>
                                    <ul class="list-unstyled sub-menu">
                                        <li><a href="#">Coats</a></li>
                                        <li><a href="#">Outerwear</a></li>
                                        <li><a href="#">Dresses</a></li>
                                        <li><a href="#">Tops</a></li>
                                        <li><a href="#">Trousers</a></li>
                                        <li><a href="#">Shirts</a></li>
                                        <li><a href="#">Jeans</a></li>
                                        <li><a href="#">T-shirts</a></li>
                                        <li><a href="#">Shoes</a></li>
                                        <li><a href="#">Handbags</a></li>
                                        <li><a href="#">Stock clearance</a></li>
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
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a href="#">Shop</a>
                            <ul class="dropdown-menu">
                                <!-- <li><a href="shop-full-width.html">Shop - Full Width</a></li> -->
                                <!-- <li><a href="shop-sidebar.html">Shop - Sidebar</a></li>
                                <li><a href="shop-list-sidebar.html">Shop List - Sidebar</a></li> -->
                                <li><a href="shop-product-detail1.html">Shop - Product Detail 1</a></li>
                                <!-- <li><a href="shop-product-detail2.html">Shop - Product Detail 2</a></li> -->
                                <li><a href="shop-cart-full.html">Shop - Cart Full</a></li>
                                <!-- <li><a href="shop-cart-sidebar.html">Shop - Cart Sidebar</a></li> -->
                                <li><a href="shop-checkout.html">Shop - Checkout</a></li>
                            </ul>
                        </li>
                        <li><a href="index-white.html">Mega Menu White</a></li>
                        <li><a href="page-404.html">404 Error Page</a></li>
                    </ul>
                </li>
                <li><a href="shortcodes.html">Shortcodes</a></li>
                <li><a href="{{ route('client.posts') }}">Blog</a></li>
                <!-- <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog</a>
                    <ul class="dropdown-menu">
                        <li><a href="blog-sidebar.html">Blog Sidebar</a></li>
                        <li><a href="blog-mini-sidebar.html">Blog Mini Sidebar</a></li>
                        <li><a href="blog-masonry.html">Blog Masonry</a></li>
                        <li><a href="blog-single.html">Blog Single</a></li>
                    </ul>
                </li> -->
                <li><a href="page-contact1.html">Contact</a></li>
                <!-- <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Contact</a>
                    <ul class="dropdown-menu">
                        <li><a href="page-contact1.html">Contact Version 1</a></li>
                        <li><a href="page-contact2.html">Contact Version 2</a></li>
                    </ul>
                </li> -->
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
