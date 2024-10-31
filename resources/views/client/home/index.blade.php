@extends('client.layouts.master')

@section('content')
    <!-- Begin Main Slide -->
    <section class="main-slide">
        <div id="owl-main-demo" class="owl-carousel main-demo">
            @foreach ($banners as $banner)
                <div class="item">
                    <div style="width: 100%; height: 500px;">
                        <img src="{{ url('storage/' . $banner->image) }}" style="width: 100%; height: 100%; object-fit:cover"
                            class="img-responsive" alt="{{ $banner->title }}">
                    </div>
                    <div class="item-caption">
                        <div class="item-caption-inner">
                            <div class="item-caption-wrap">
                                <p class="item-cat"><a href="#">{{ $banner->title }}</a></p>
                                <a href="#" class="btn btn-white hidden-xs">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- End Main Slide -->

    <!-- Begin Ads -->
    <section class="ads">
        <div class="container">
            <div class="row">
                @foreach($listBanner1 as $banner)
                    <div class="col-xs-4 animation">
                       <div style="width: 100%; height: 250px;">
                        <a href="#"><img  style="width: 100%; height: 100%; object-fit:cover" src="{{ asset('storage/' . $banner->image) }}" class="img-responsive" alt="{{ $banner->title }}"></a>
                       </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Ads -->

    <!-- Begin Top Selling -->
    <section class="products-slide">
        <div class="container">
            <h2 class="title"><span>Top Sản Phẩm Bán Chạy</span></h2>
            <div class="row">
                <div id="owl-product-slide" class="owl-carousel product-slide">
                    @foreach ($topSeller as $product)
                        <div class="col-md-12 animation">
                            <div class="item product">
                                <div class="product-thumb-info">
                                    <div class="product-thumb-info-image">
                                        <span class="product-thumb-info-act">
                                            <a href="" data-toggle="modal" data-target=".quickview-wrapper"
                                                class="view-product" data-id="{{ $product->id }}">
                                                <span><i class="fa fa-external-link"></i></span>
                                            </a>
                                            <a href="shop-cart-full.html" class="add-to-cart-product">
                                                <span><i class="fa fa-shopping-cart"></i></span>
                                            </a>
                                        </span>
                                        <a href="{{ route('client.product.show', $product->id) }}">
                                            <img loading="lazy" alt="" class="img-responsive"
                                                src="{{ $product->image }}">
                                        </a>
                                    </div>

                                    <div class="product-thumb-info-content">
                                        <span class="price pull-right">{{ number_format($product->price_regular, 0, ',', '.') }} đ</span>
                                        <h4>
                                            <a href="{{ route('client.product.show', $product->id) }}">
                                                {{ $product->name }}
                                            </a>
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
        </div>
    </section>
    <!-- End Top Selling -->

    <!-- Begin New Products -->
    <section class="product-tab">
        <div class="container">
            <h2 class="title"><span>Sản phẩm mới</span></h2>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs pro-tabs text-center animation" role="tablist">
                <li class="active"><a href="#man" role="tab" data-toggle="tab">Nam</a></li>
                <li><a href="#woman" role="tab" data-toggle="tab">Nữ</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="man">
                    <div class="row">
                        @foreach ($newProductMan as $product)
                        <div class="col-xs-6 col-sm-3 animation">
                            <div class="product">
                                <div class="product-thumb-info">
                                    <div class="product-thumb-info-image">
                                        <span class="product-thumb-info-act">
                                            <a href="" data-toggle="modal"
                                                data-target=".quickview-wrapper" class="view-product"
                                                data-id="{{ $product->id }}">
                                                <span><i class="fa fa-external-link"></i></span>
                                            </a>
                                            <a href="shop-cart-full.html" class="add-to-cart-product">
                                                <span><i class="fa fa-shopping-cart"></i></span>
                                            </a>
                                        </span>
                                        <a href="{{ route('client.product.show', $product->id) }}">
                                            <img alt="" class="img-responsive"
                                                src="{{ $product->image }}">
                                        </a>
                                    </div>
                                    <div class="product-thumb-info-content">
                                        <span class="price pull-right">{{ number_format($product->price_regular, 0, ',', '.') }} đ</span>
                                        <h4>
                                            <a
                                                href="{{ route('client.product.show', $product->id) }}">{{ $product->name }}</a>
                                        </h4>
                                        <span class="item-cat"><small><a
                                                    href="#">{{ $product->category->name }}</a></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane" id="woman">
                    <div class="row">
                        @foreach ($newProductWoman as $product)
                        <div class="col-xs-6 col-sm-3 animation">
                            <div class="product">
                                <div class="product-thumb-info">
                                    <div class="product-thumb-info-image">
                                        <span class="product-thumb-info-act">
                                            <a href="" data-toggle="modal"
                                                data-target=".quickview-wrapper" class="view-product"
                                                data-id="{{ $product->id }}">
                                                <span><i class="fa fa-external-link"></i></span>
                                            </a>
                                            <a href="shop-cart-full.html" class="add-to-cart-product">
                                                <span><i class="fa fa-shopping-cart"></i></span>
                                            </a>
                                        </span>
                                        <a href="{{ route('client.product.show', $product->id) }}">
                                            <img alt="" class="img-responsive"
                                                src="{{ $product->image }}">
                                        </a>
                                    </div>
                                    <div class="product-thumb-info-content">
                                        <span class="price pull-right">{{ number_format($product->price_regular, 0, ',', '.') }} đ</span>
                                        <h4>
                                            <a
                                                href="{{ route('client.product.show', $product->id) }}">{{ $product->name }}</a>
                                        </h4>
                                        <span class="item-cat"><small><a
                                                    href="#">{{ $product->category->name }}</a></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End New Products -->

    <!-- Begin Parallax -->
    @foreach($listBanner2 as $banner)
    <div style="width: 100%; height: 500px;">
        <section class="pi-parallax" data-stellar-background-ratio="0.6" style="background-image: url('{{ asset('storage/' . $banner->image) }}'); background-size: cover; width: 100%; height: 100%; object-fit:cover; background-repeat: no-repeat;">
            <div class="container">
                <div id="owl-text-slide" class="owl-carousel">
                    <div class="item">
                        <blockquote>
                            <p>{{ $banner->title }}</p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endforeach
    <!-- End Parallax -->

    <!-- Begin Latest Blogs -->
    <section class="latest-blog">
        <div class="container">
            <h2 class="title"><span>Bài viết mới nhất</span></h2>
            <div class="row">
                @foreach ($latestPosts as $post)
                    <div class="col-xs-6 animation">
                        <article class="post">
                            <div class="post-image">
                                <span class="post-info-act">
                                    <a href="blog-single.html"><i class="fa fa-caret-right"></i></a>
                                </span>
                                <img class="img-responsive" src="{{ $post->image }}" alt="Blog">
                            </div>
                            <h3><a href="blog-single.html">{{ $post->title }}</a></h3>
                            <p class="post-meta">{{ $post->publish_date }}</p>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Latest Blogs -->
@endsection
