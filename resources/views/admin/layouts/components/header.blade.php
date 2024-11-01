<!-- HEADER DESKTOP-->
<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="#">
                    <img src="{{ asset('assets/admin/images/icon/logo-white.png') }}" alt="CoolAdmin" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="has-sub">
                        <a href="index3.html">
                            <i></i>Điều khiển
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('admin.post.index') }}">
                            <i class="fas fa-shopping-basket"></i>
                            <span class="bot-line"></span>Bài đăng</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.category.index') }}">
                            <i class="fas fa-trophy"></i>
                            <span class="bot-line"></span>Category</a>
                    </li>
                    <li class="has-sub">
                        <a href="{{ route('admin.user.index') }}">
                            <i ></i>
                            <span class="bot-line"></span>Quản lý tài khoản</a>

                    </li>
                    <li class="has-sub">
                        <a href="#">
                            <i ></i>
                            <span class="bot-line"></span>Sản phẩm</a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="{{ route('admin.products.index') }}">Quản lý sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.products.variants.index') }}">Sản phẩm biến thể</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.products.variants.getAllAttribute') }}">Thuộc tính biến thể</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.inventories.index') }}">Tồn kho</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="{{ route('admin.orders.index') }}">
                            <i class="fas fa-list-ul"></i>
                            <span class="bot-line"></span>Đơn hàng</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.voucher.index') }}">
                            <span class="bot-line"></span>Quản lý mã giảm giá
                        </a>
                    <li class="has-sub">
                        <a href="#">
                            
                            <span class="bot-line"></span>Quảng cáo</a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="{{ route('admin.slider.index') }}">Slider chính </a>
                            <li>
                                <a href="{{ route('admin.slider.banner1.index')}}">Banner giảm giá</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.slider.banner2.index')}}">Banner giới thiệu</a>
                            </li>
                        </ul>
                        
                    </li><li class="has-sub">
                        <a href="{{ route('admin.orders.index') }}">
                            <i></i>
                            <span class="bot-line"></span>Quản lý đơn hàng</a>
                        
                    </li>
                </ul>
            </div>
            <div class="header__tool">
                <div class="header-button-item has-noti js-item-menu">
                    <i class="zmdi zmdi-notifications"></i>
                    <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                        <div class="notifi__title">
                            <p>You have 3 Notifications</p>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c1 img-cir img-40">
                                <i class="zmdi zmdi-email-open"></i>
                            </div>
                            <div class="content">
                                <p>You got a email notification</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c2 img-cir img-40">
                                <i class="zmdi zmdi-account-box"></i>
                            </div>
                            <div class="content">
                                <p>Your account has been blocked</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c3 img-cir img-40">
                                <i class="zmdi zmdi-file-text"></i>
                            </div>
                            <div class="content">
                                <p>You got a new file</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__footer">
                            <a href="#">All notifications</a>
                        </div>
                    </div>
                </div>
                <div class="header-button-item js-item-menu">
                    <i class="zmdi zmdi-settings"></i>
                    <div class="setting-dropdown js-dropdown">
                        <div class="account-dropdown__body">
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-account"></i>Account</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-settings"></i>Setting</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-money-box"></i>Billing</a>
                            </div>
                        </div>
                        <div class="account-dropdown__body">
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-globe"></i>Language</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-pin"></i>Location</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-email"></i>Email</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-notifications"></i>Notifications</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <img src="{{ asset('assets/admin/images/icon/avatar-01.jpg') }}" alt="John Doe" />
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#">
                                        @if (Auth::user()->user_image)
                                            <img src="{{ Storage::url(Auth::user()->user_image) }}" alt="">
                                        @else
                                            <img src="{{ asset('assets/admin/images/icon/avatar-01.jpg') }}"
                                                alt="" />
                                        @endif
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="#">{{ Auth::user()->name }}</a>
                                    </h5>
                                    <span class="email">{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-account"></i>Tài khoản</a>
                                </div>

                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-settings"></i>Cài đặt</a>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="#">
                                    <i class="zmdi zmdi-power"></i>Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER DESKTOP-->
