@extends('client.layouts.master')

@section('title', 'Danh sách sản phẩm')

@section('text_page')
    Mua sắm
@endsection

@section('content')
    @include('client.layouts.components.pagetop', ['md' => 'md'])

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <aside class="sidebar">
                    <aside class="block filter-blk">
                        <h4>Lọc theo giá</h4>
                        <div id="price-range">
                            <div class="padding-range">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="price1" name="price" value="0-5000000">
                                    <label class="form-check-label" for="price1">Dưới 5,000,000đ</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="price2" name="price" value="5000000-10000000">
                                    <label class="form-check-label" for="price2">5,000,000đ-10,000,000đ</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="price3" name="price" value="10000000-1000000000">
                                    <label class="form-check-label" for="price3">Trên 10,000,000đ</label>
                                </div>
                                <p class="clearfix mt-2"><a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                        onclick="filterByPrice()">Apply Filter</a></p>
                            </div>
                        </div>
                    </aside>
                    <aside class="block blk-cat">
                        <h4>Danh mục</h4>
                        <ul class="list-unstyled list-cat">
                            <li><a href="javascript:void(0);" onclick="showAllProducts()">All Products</a></li>
                            @foreach ($categories as $category)
                                <li><a href=""
                                        onclick="filterByCategory({{ $category->id }})">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </aside>

                    <aside class="block blk-colors">
                        <h4>Màu sắc</h4>
                        <ul class="list-unstyled list-cat">
                            <li><a href="javascript:void(0);" onclick="showAllProducts()">All Colors</a></li>
                            @foreach ($colors as $color)
                                <li><a href="javascript:void(0);"
                                        onclick="filterByColor({{ $color->id }})">{{ $color->name }}</a></li>
                            @endforeach
                        </ul>
                    </aside>

                    <aside class="block featured">
                        <h4>Sản phẩm trending</h4>
                        <ul class="list-unstyled list-thumbs-pro">
                            <li class="product">
                                <div class="product-thumb-info">
                                    <div class="product-thumb-info-image">
                                        <a href="shop-product-detail1.html"><img alt="" width="60"
                                                src="/assets/client/images/content/products/product-7.jpg"></a>
                                    </div>

                                    <div class="product-thumb-info-content">
                                        <h4><a href="shop-product-detail2.html">Striped sweater</a></h4>
                                        <span class="item-cat"><small><a href="#">Stock clearance</a></small></span>
                                        <span class="price">29.99 USD</span>
                                    </div>
                                </div>
                            </li>
                            <li class="product">
                                <div class="product-thumb-info">
                                    <div class="product-thumb-info-image">
                                        <a href="shop-product-detail1.html"><img alt="" width="60"
                                                src="/assets/client/images/content/products/product-8.jpg"></a>
                                    </div>

                                    <div class="product-thumb-info-content">
                                        <h4><a href="shop-product-detail2.html">Checked shirt with pocket</a></h4>
                                        <span class="item-cat"><small><a href="#">Shirts</a></small></span>
                                        <span class="price">29.99 USD</span>
                                    </div>
                                </div>
                            </li>
                            <li class="product">
                                <div class="product-thumb-info">
                                    <div class="product-thumb-info-image">
                                        <a href="shop-product-detail1.html"><img alt="" width="60"
                                                src="/assets/client/images/content/products/product-9.jpg"></a>
                                    </div>

                                    <div class="product-thumb-info-content">
                                        <h4><a href="shop-product-detail2.html">Classic blazer</a></h4>
                                        <span class="item-cat"><small><a href="#">Outerwear</a></small></span>
                                        <span class="price">29.99 USD</span>
                                    </div>
                                </div>
                            </li>
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
                            <select class="formDropdown">
                                <option>Sắp xếp mặc định</option>
                                <option>Sắp xếp theo mức độ phổ biến</option>
                                <option>Sắp xếp theo độ mới</option>
                            </select>
                        </div>
                    </div>
                    <div id="products-grid">
                        <div class="tab-pane active" id="man">
                            <div class="row" id="product-container">
                                @foreach ($products as $product)
                                    <div class="col-xs-6 col-sm-4 animation"
                                        data-category-id="{{ $product->category->id }}"
                                        data-color-id="{{ $product->color_id }}"
                                        data-price="{{ $product->price_regular }}">
                                        <div class="product" data-category="{{ $product->category->name }}">
                                            <div class="product-thumb-info">
                                                <div class="product-thumb-info-image">
                                                    <span class="product-thumb-info-act">
                                                        <a href="" data-toggle="modal"
                                                            data-target=".quickview-wrapper" class="view-product"
                                                            data-id="{{ $product->id }}">
                                                            <span><i class="fa fa-external-link"></i></span>
                                                        </a>
                                                        {{-- <a href="shop-cart-full.html" class="add-to-cart-product">
                                                            <span><i class="fa fa-shopping-cart"></i></span>
                                                        </a> --}}
                                                    </span>
                                                    <a href="{{ route('client.product.show', $product->id) }}">
                                                        <img alt="" class="img-responsive"
                                                            src="{{ $product->image }}">
                                                    </a>
                                                </div>
                                                <div class="product-thumb-info-content">
                                                    <span class="price pull-right">{{ $product->price_regular }} đ</span>
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
                                                        src="{{ $product->image }}">
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
                                                    <span>({{ $product->reviews->count() }}) Reviews</span> |
                                                    {{-- <a href="#">Add Your Review</a> --}}
                                                </div>
                                                <p class="price">{{ $product->price_regular }} đ</p>
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
                        @if ($products->hasPages())
                            <nav>
                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($products->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true"
                                            aria-label="@lang('pagination.previous')">
                                            <span class="page-link" aria-hidden="true">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->previousPageUrl() }}"
                                                rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($products->links()->elements as $element)
                                        {{-- "Three Dots" Separator --}}
                                        @if (is_string($element))
                                            <li class="page-item disabled" aria-disabled="true"><span
                                                    class="page-link">{{ $element }}</span></li>
                                        @endif

                                        {{-- Array Of Links --}}
                                        @if (is_array($element))
                                            @foreach ($element as $page => $url)
                                                @if ($page == $products->currentPage())
                                                    <li class="page-item active" aria-current="page"><span
                                                            class="page-link">{{ $page }}</span></li>
                                                @else
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{ $url }}">{{ $page }}</a></li>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($products->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next"
                                                aria-label="@lang('pagination.next')">&raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled" aria-disabled="true"
                                            aria-label="@lang('pagination.next')">
                                            <span class="page-link" aria-hidden="true">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
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

        function filterByCategory(categoryId) {
            var products = document.querySelectorAll('#product-container .animation');
            products.forEach(function(product) {
                if (product.getAttribute('data-category-id') == categoryId || categoryId == 0) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
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
            var selectedPrices = document.querySelectorAll('input[name="price"]:checked');
            var products = document.querySelectorAll('#product-container .animation');
            if (selectedPrices.length === 0) {
                products.forEach(function(product) {
                    product.style.display = 'block';
                });
                return;
            }
            products.forEach(function(product) {
                var productPrice = parseFloat(product.getAttribute('data-price'));
                var showProduct = false;
                selectedPrices.forEach(function(price) {
                    var priceRange = price.value.split('-');
                    var minPrice = parseFloat(priceRange[0]);
                    var maxPrice = parseFloat(priceRange[1]);
                    if (productPrice >= minPrice && productPrice <= maxPrice) {
                        showProduct = true;
                    }
                });
                if (showProduct) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        function showAllProducts() {
            var products = document.querySelectorAll('#product-container .animation');
            products.forEach(function(product) {
                product.style.display = 'block';
            });
        }
    </script>
    <script>
        @if (request('type'))
            filterByCategory({{ request('type') }});
            history.pushState(null, null, "{{ route('client.product.index') }}");
        @endif
    </script>
@endsection
