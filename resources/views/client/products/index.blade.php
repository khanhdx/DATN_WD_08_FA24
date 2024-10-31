@extends('client.layouts.master')

@section('text_page')
    Shopping
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
                                <div id="slider-range"></div>
                            </div>
                            <label for="amount">Price:</label>
                            <input type="text" id="amount">
                            <p class="clearfix"><a href="#" class="btn btn-primary btn-sm">Apply Filter</a></p>
                        </div>
                    </aside>
                    <aside class="block blk-cat">
                        <h4>Danh mục</h4>
                        <ul class="list-unstyled list-cat">
                            @foreach ($categories as $category)
                                <li><a href=""
                                        onclick="filterByCategory({{ $category->id }})">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </aside>

                    <aside class="block blk-colors">
                        <h4>Màu sắc</h4>
                        <ul class="list-unstyled list-cat">
                            @foreach ($colors as $color)
                                <li><a href="#">{{ $color->name }}</a></li>
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
                            <li class="active"><a href="shop-sidebar.html"><i class="fa fa-th"></i></a></li>
                            <li><a href="shop-list-sidebar.html"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                        <p class="pull-left">Showing 1-12 of 50 results</p>
                        <!-- Ordering -->
                        <div class="list-sort pull-right">
                            <select class="formDropdown">
                                <option>Default Sorting</option>
                                <option>Sort by Popularity</option>
                                <option>Sort by Newness</option>
                            </select>
                        </div>
                    </div>
                    <div class="container">
                        @foreach ($products->chunk(3) as $chunk)
                            <div class="row">
                                @foreach ($chunk as $product)
                                    <div class="col-xs-12 col-sm-6 col-md-4 animation">
                                        <div class="product">
                                            <div class="product-thumb-info">
                                                <div class="product-thumb-info-image">
                                                    <span class="product-thumb-info-act">
                                                        <a href="" data-toggle="modal" data-id="{{ $product->id }}"
                                                            data-target=".quickview-wrapper" class="view-product">
                                                            <span><i class="fa fa-external-link"></i></span>
                                                        </a>
                                                        <a href="shop-cart-full.html" class="add-to-cart-product">
                                                            <span><i class="fa fa-shopping-cart"></i></span>
                                                        </a>
                                                    </span>
                                                    <img alt="{{ $product->name }}" class="img-responsive"
                                                        src="{{ url($product->image) }}">
                                                </div>
                                                <div class="product-thumb-info-content">
                                                    <h4>{{ $product->name }}</h4>
                                                    <div class="price-container">
                                                        <span class="price-regular">{{ $product->price_regular }} đ</span>
                                                        <span class="price-sale">{{ $product->price_sale }} đ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
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
                                            <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev"
                                                aria-label="@lang('pagination.previous')">&laquo;</a>
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
