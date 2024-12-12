<aside class="menu-sidebar2">
    <div class="logo">
        <a href="{{ route('admin.dashboard') }}">
            <img src="/assets/admin/images/icon/logo-white.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar1">
        <div class="account2">
            <div class="image img-cir img-120">
                @if (Auth::user()->user_image ?? null )
                    <img style="border: 1px solid silver; border-radius: 50%;width: 120px;height: 120px;object-fit: cover;" src="{{ asset('storage/' . Auth::user()->user_image) }}" alt="{{ Auth::user()->name }}">
                @else
                    <img src="/assets/admin/images/icon/avatar-big-01.jpg" alt="John Doe" />   
                @endif
            </div>
            <a href="{{ route('admin.project') }}"><h4 class="name">{{ Auth::user()->name ?? null }}</h4></a>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn m-0 p-0" type="submit" style="box-shadow: none;">
                    <span class="text-secondary">Đăng xuất</span>
                </button>
            </form>
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>Quản lý
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        
                        <li>
                            <a href="{{ route('admin.category.index') }}">
                                <i class="fas fa-list-ul"></i>Danh mục</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.user.index') }}">
                                <i class="fas fa-users"></i>Tài khoản</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.orders.index') }}">
                                <i class="fas fa-shopping-basket"></i>Đơn hàng</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.voucher.index') }}">
                                <i class="fa fa-tags"></i>Mã giảm giá</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reviews.index') }}">
                                <i class="fas fa-file-text"></i>Đánh giá</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.slider.index') }}">
                                <i class="far fa-window-restore"></i>Slider</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.images.index') }}">
                                <i class="far fa-window-restore"></i>Ảnh trưng bày</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.post.index') }}">
                                <i class="fas fa-file-text"></i>Bài viết</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.comments.index') }}">
                                <i class="fas fa-file-text"></i>Bình luận bài viết</a>
                        </li>
                    </ul>
                </li>

                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-inbox"></i>Sản phẩm
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ route('admin.products.index') }}">
                                <i class="fas fa-table"></i>Quản lý sản phẩm</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products.variants.index') }}">
                                <i class="fas fa-cog "></i>Sản phẩm biến thể</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products.variants.getAllAttribute') }}">
                                <i class="fas fa-code-fork"></i>Thuộc tính biến thể</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.inventories.index') }}">
                                <i class="fas fa-archive"></i>Tồn kho</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="{{ route('admin.chat') }}">
                        <i class="far fa-envelope"></i>Chat</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
