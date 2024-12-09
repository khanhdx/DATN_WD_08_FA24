@extends('client.layouts.master')

@section('title', 'Danh sách sản phẩm')

@section('text_page')
    Mua sắm
@endsection

@section('content')
    @include('client.layouts.components.pagetop', ['md' => 'md'])

    <div class="container mb-6">
        <div class="row">
            <div class="col-md-3">
                <aside class="sidebar">
                    <aside class="block filter-blk">
                        <h4>Lọc theo giá</h4>
                        <form action="{{ route('client.product.index') }}" method="GET">
                            <div class="form-group">
                                <label for="price">Chọn giá:</label><br>
                                <label>
                                    <input type="checkbox" name="prices[]" value="0-5000000" 
                                        {{ in_array('0-5000000', request('prices', [])) ? 'checked' : '' }}>
                                    Dưới 5,000,000đ
                                </label><br>
                                <label>
                                    <input type="checkbox" name="prices[]" value="5000000-10000000" 
                                        {{ in_array('5000000-10000000', request('prices', [])) ? 'checked' : '' }}>
                                    5,000,000đ - 10,000,000đ
                                </label><br>
                                <label>
                                    <input type="checkbox" name="prices[]" value="10000000-500000000" 
                                        {{ in_array('10000000-500000000', request('prices', [])) ? 'checked' : '' }}>
                                    Trên 10,000,000đ
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Lọc</button>
                        </form>
                    </aside>
                    <aside class="block blk-cat">
                        <h4>Danh mục</h4>
                        <ul class="list-unstyled list-cat">
                            <li>
                                <a href="javascript:void(0);" onclick="showAllProducts()">Tất cả sản phẩm</a>
                            </li>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="?category_id={{ $category->id }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </aside>



                    <aside class="block featured">
                        <h4>Sản phẩm trending</h4>
                        <ul class="list-unstyled list-thumbs-pro">
                            @foreach ($trendingProducts as $product)
                                <li class="product">
                                    <div class="product-thumb-info">
                                        <div class="product-thumb-info-image">
                                            <a href="{{ route('client.product.show', $product->id) }}">
                                                <img alt="{{ $product->name }}" width="60"
                                                    src="{{ \Storage::url($product->image->image_url) }}">
                                            </a>
                                        </div>

                                        <div class="product-thumb-info-content">
                                            <h4>
                                                <a
                                                    href="{{ route('client.product.show', $product->id) }}">{{ $product->name }}</a>
                                            </h4>
                                            <span class="item-cat">
                                                <small><a href="#">{{ $product->category->name }}</a></small>
                                            </span>
                                            <span
                                                class="price">{{ number_format($product->price_sale ?? number_format($product->price_regular, 0, ',', '.'), 0, ',', '.') }}
                                                đ</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </aside>

                </aside>
            </div>
            <div class="col-md-9">
                <div class="catalog">
                    <div class="toolbar clearfix">
                        <ul class="list-inline list-icons pull-left">
                            <li id="grid-view" class="active"><a href=""><i class="fa fa-th"></i></a></li>
                            <li id="list-view"><a href=""><i class="fa fa-th-list"></i></a></li>
                        </ul>
                        {{-- <p class="pull-left">Showing 1-12 of 50 results</p> --}}
                        <!-- Ordering -->
                        <div class="list-sort pull-right">
                            <select class="formDropdown" id="sortDropdown">
                                <option value="">Sắp xếp mặc định</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Sắp xếp theo giá thấp đến cao</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Sắp xếp theo giá cao đến thấp</option>
                            </select>
                        </div>
                    </div>
                    <div id="products-grid">
                        <p id="no-products-message" class="text-center text-danger" style="display:none;">Không tìm thấy sản phẩm nào.</p>

                        <div class="tab-pane active" id="man">
                            <div class="row" id="product-container">
                                @foreach ($products as $product)
                                    <div class="col-xs-6 col-sm-4 animation"
                                        data-category-id="{{ $product->category->id }}"
                                        data-color-id="{{ $product->color_id }}"
                                        data-price="{{ number_format($product->price_regular, 0, ',', '.') }}">
                                        <div class="product" data-category="{{ $product->category->name }}">
                                            <div class="product-thumb-info">
                                                <div class="product-thumb-info-image">
                                                    <span class="product-thumb-info-act">
                                                        <a href="" data-toggle="modal"
                                                            data-target=".quickview-wrapper" class="view-product"
                                                            data-id="{{ $product->id }}">
                                                            <span><i class="fa fa-external-link"></i></span>
                                                        </a>
                                                    </span>
                                                    <a href="{{ route('client.product.show', $product->id) }}">
                                                        <img alt="" class="img-responsive"
                                                            src="{{ \Storage::url($product->image->image_url) }}">
                                                    </a>
                                                </div>
                                                <div class="product-thumb-info-content">
                                                    <span class="price pull-right">{{ number_format($product->price_regular, 0, ',', '.') }} đ</span>
                                                    <h4><a
                                                            href="{{ route('client.product.show', $product->id) }}">{{ $product->name }}</a>
                                                    </h4>
                                                    <span class="item-cat">
                                                        <small>
                                                            <a href="#">{{ $product->category->name }}</a>
                                                        </small>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="product product-list animation">
                            @foreach ($products as $product)
                                <div class="product-thumb-info" data-category-id="{{ $product->category->id }}">
                                    <div class="row">
                                        <div class="col-xs-5 col-sm-3">
                                            <div class="product-thumb-info-image">
                                                <a href="{{ route('client.product.show', $product->id) }}">
                                                    <img alt="" class="img-responsive"
                                                        src="{{ \Storage::url($product->image->image_url) }}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xs-7 col-sm-9">
                                            <div class="product-thumb-info-content">
                                                <h4><a
                                                        href="{{ route('client.product.show', $product->id) }}">{{ $product->name }}</a>
                                                </h4>
                                                <div class="reviews-counter clearfix">
                                                    <div class="rating five-stars pull-left">
                                                        <div class="star-rating"></div>
                                                        <div class="star-bg"></div>
                                                    </div>
                                                    <span>({{ $product->reviews->count() }}) Reviews</span>
                                                    {{-- <a href="#">Add Your Review</a> --}}
                                                </div>
                                                <p class="price">{{ number_format($product->price_regular, 0, ',', '.') }} đ</p>
                                                <p>{{ $product->description }}</p>
                                                <p class="btn-group">
                                                    {{-- <button class="btn btn-sm btn-icon" href="#"><i class="fa fa-shopping-cart"></i> Add to cart</button> --}}
                                                    <a href="javascript:void(0);" data-toggle="modal"
                                                        data-target=".quickview-wrapper" class="view-product"
                                                        data-id="{{ $product->id }}">
                                                        <span><i class="fa fa-eye"></i></span>
                                                    </a>
                                                    <a href="#">
                                                        <span><i class="fa fa-heart-o"></i></span>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="pagination-wrapper">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .product-list {
            display: none;
        }

        .product-thumb-info-image {
            position: relative;
        }

        .product-thumb-info-act {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-thumb-info-image:hover .product-thumb-info-act {
            opacity: 1;
        }

        .price-regular {
            color: rgb(0, 255, 157);
        }

        .price-sale {
            color: black;
            text-decoration: line-through;
        }
    </style>
@endsection

@section('js')
    <script>
        document.getElementById('list-view').addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelector('.product-list').style.display = 'block';
            document.querySelector('.tab-pane').style.display = 'none';
            document.getElementById('grid-view').classList.remove('active');
            this.classList.add('active');
        });

        document.getElementById('grid-view').addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelector('.product-list').style.display = 'none';
            document.querySelector('.tab-pane').style.display = 'block';
            document.getElementById('list-view').classList.remove('active');
            this.classList.add('active');
        });
        function resetFilters() {
    var products = document.querySelectorAll('#product-container .animation');
    products.forEach(function (product) {
        product.style.display = 'block'; // Hiển thị lại tất cả sản phẩm
    });

    // Bỏ chọn các checkbox lọc giá
    var priceFilters = document.querySelectorAll('input[name="price"]');
    priceFilters.forEach(function (checkbox) {
        checkbox.checked = false;
    });
}

function filterByCategory(categoryId) {
    resetFilters(); // Reset các bộ lọc
    var products = document.querySelectorAll('#product-container .animation');
    products.forEach(function (product) {
        if (product.getAttribute('data-category-id') == categoryId || categoryId == 0) {
            product.style.display = 'block'; // Hiển thị sản phẩm phù hợp
        } else {
            product.style.display = 'none'; // Ẩn các sản phẩm không khớp
        }
    });

    // Cập nhật URL mà không tải lại trang
    var newUrl = new URL(window.location.href);
    if (categoryId == 0) {
        newUrl.searchParams.delete('category_id');
    } else {
        newUrl.searchParams.set('category_id', categoryId);
    }
    history.pushState({}, '', newUrl);
}

        function filterByColor(colorId) {
            var products = document.querySelectorAll('#product-container .animation');
            products.forEach(function(product) {
                if (product.getAttribute('data-color-id') == colorId || colorId == 0) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        function filterByPrice() {
    const selectedPrices = Array.from(document.querySelectorAll('input[name="prices[]"]:checked'));
    const products = document.querySelectorAll('#product-container .animation');

    if (selectedPrices.length === 0) {
        products.forEach(product => product.style.display = 'block');
        checkNoProducts();
        return;
    }

    products.forEach(product => {
        const productPrice = parseInt(product.getAttribute('data-price').replace(/\./g, ''), 10);
        let isMatch = false;

        selectedPrices.forEach(price => {
            const [min, max] = price.value.split('-').map(Number);
            if (productPrice >= min && productPrice <= max) {
                isMatch = true;
            }
        });

        product.style.display = isMatch ? 'block' : 'none';
    });

    checkNoProducts();
}


function checkNoProducts() {
    const visibleProducts = Array.from(document.querySelectorAll('#product-container .animation'))
        .filter(product => product.style.display !== 'none');
    
    const noProductsMessage = document.getElementById('no-products-message');
    
    if (visibleProducts.length === 0) {
        if (!noProductsMessage) {
            const message = document.createElement('p');
            message.id = 'no-products-message';
            message.className = 'text-center text-danger';
            message.textContent = 'Không tìm thấy sản phẩm nào.';
            document.getElementById('product-container').appendChild(message);
        }
    } else if (noProductsMessage) {
        noProductsMessage.remove();
    }
}

// Xóa thông báo khi hiển thị tất cả sản phẩm
function showAllProducts() {
    document.querySelectorAll('#product-container .animation').forEach(product => {
        product.style.display = 'block';
    });
    checkNoProducts();
}

function showAllProducts() {
    // Lấy tất cả các sản phẩm trong #product-container
    document.querySelectorAll('#product-container .animation').forEach(product => {
        product.style.display = 'block'; // Hiển thị sản phẩm
    });

    // Kiểm tra nếu không có sản phẩm nào, hiển thị thông báo không tìm thấy
}
document.getElementById('sortDropdown').addEventListener('change', function () {
        const selectedSort = this.value;
        const url = new URL(window.location.href);
        
        // Update URL with selected sort parameter
        if (selectedSort) {
            url.searchParams.set('sort', selectedSort);
        } else {
            url.searchParams.delete('sort');
        }

        // Navigate to updated URL
        window.location.href = url.toString();
    });

    </script>
    <script>
        @if (request('type'))
            filterByCategory({{ request('type') }});
            history.pushState(null, null, "{{ route('client.product.index') }}");
        @endif
    </script>
@endsection
