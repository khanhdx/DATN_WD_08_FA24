@extends('client.layouts.master')

@section('content')
    <div role="main" class="main">
        <!-- Begin Main Slide -->
        <section class="main-slide">
            <div id="owl-main-demo" class="owl-carousel main-demo">
                <div class="item" id="item1"><img src="/assets/client/images/content/slides/slider1.jpg"
                        class="img-responsive" alt="Photo">
                    <div class="item-caption">
                        <div class="item-caption-inner">
                            <div class="item-caption-wrap">
                                <p class="item-cat"><a href="#">Fall/Winter 2014</a></p>
                                <h2>Up to 50% off<br>on selected items</h2>
                                <a href="#" class="btn btn-white hidden-xs">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item" id="item2"><img src="/assets/client/images/content/slides/slider2.jpg"
                        class="img-responsive" alt="Photo">
                    <div class="item-caption">
                        <div class="item-caption-inner">
                            <div class="item-caption-wrap">
                                <p class="item-cat"><a href="#">Top</a></p>
                                <h2>25% off<br>for pink swim</h2>
                                <a href="#" class="btn btn-white hidden-xs">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item" id="item3"><img src="/assets/client/images/content/slides/slider3.jpg"
                        class="img-responsive" alt="Photo">
                    <div class="item-caption">
                        <div class="item-caption-inner">
                            <div class="item-caption-wrap">
                                <p class="item-cat"><a href="#">Panties</a></p>
                                <h2>Free shipping<br>on $50 plus $20</h2>
                                <a href="#" class="btn btn-white hidden-xs">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Main Slide -->

        <!-- Begin Ads -->
        <section class="ads">
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 animation">
                        <a href="#"><img src="/assets/client/images/content/products/ad-1.png" class="img-responsive"
                                alt="Ad"></a>
                    </div>
                    <div class="col-xs-4 animation">
                        <a href="#"><img src="/assets/client/images/content/products/ad-2.png" class="img-responsive"
                                alt="Ad"></a>
                    </div>
                    <div class="col-xs-4 animation">
                        <a href="#"><img src="/assets/client/images/content/products/ad-3.png" class="img-responsive"
                                alt="Ad"></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Ads -->

        <!-- Begin Top Selling -->
        <section class="products-slide">
            <div class="container">
                <h2 class="title"><span>Top Selling</span></h2>
                <div class="row">
                    <div id="owl-product-slide" class="owl-carousel product-slide">
                        @foreach ($topSeller as $product)
                            <div class="col-md-12 animation">
                                <div class="item product">
                                    <div class="product-thumb-info">
                                        <div class="product-thumb-info-image">
                                            <span class="product-thumb-info-act">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target=".quickview-wrapper" class="view-product">
                                                    <span><i class="fa fa-external-link"></i></span>
                                                </a>
                                                <a href="shop-cart-full.html" class="add-to-cart-product">
                                                    <span><i class="fa fa-shopping-cart"></i></span>
                                                </a>
                                            </span>
                                            <a href="{{ route('client.product_detail', $product->id) }}">
                                                <img alt="" class="img-responsive"
                                                    src="{{ $product->image }}">
                                            </a>
                                        </div>

                                        <div class="product-thumb-info-content">
                                            <span class="price pull-right">{{ $product->price_regular }} USD</span>
                                            <h4><a href="shop-product-detail2.html">{{ $product->name }}</a></h4>
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
        </section>
        <!-- End Top Selling -->

        <!-- Begin New Products -->
        <section class="product-tab">
            <div class="container">
                <h2 class="title"><span>New Products</span></h2>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs pro-tabs text-center animation" role="tablist">
                    <li class="active"><a href="#man" role="tab" data-toggle="tab">Man</a></li>
                    <li><a href="#woman" role="tab" data-toggle="tab">Woman</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="man">
                        <div class="row">
                            @foreach ($newProduct as $product)
                                @if ($product->category->type == 'Man')
                                    <div class="col-xs-6 col-sm-3 animation">
                                        <div class="product">
                                            <div class="product-thumb-info">
                                                <div class="product-thumb-info-image">
                                                    <span class="product-thumb-info-act">
                                                        <a href="javascript:void(0);" data-toggle="modal"
                                                            data-target=".quickview-wrapper" class="view-product">
                                                            <span><i class="fa fa-external-link"></i></span>
                                                        </a>
                                                        <a href="shop-cart-full.html" class="add-to-cart-product">
                                                            <span><i class="fa fa-shopping-cart"></i></span>
                                                        </a>
                                                    </span>
                                                    <a href="{{ route('client.product_detail', $product->id) }}">
                                                        <img alt="" class="img-responsive"
                                                            src="{{ $product->image }}">
                                                    </a>
                                                </div>
                                                <div class="product-thumb-info-content">
                                                    <span class="price pull-right">{{ $product->price_regular }} USD</span>
                                                    <h4><a href="shop-product-detail2.html">{{ $product->name }}</a></h4>
                                                    <span class="item-cat"><small><a
                                                                href="#">{{ $product->category->name }}</a></small></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane" id="woman">
                        <div class="row">
                            @foreach ($newProduct as $product)
                                @if ($product->category->type == 'Woman')
                                    <div class="col-xs-6 col-sm-3 animation">
                                        <div class="product">
                                            <div class="product-thumb-info">
                                                <div class="product-thumb-info-image">
                                                    <span class="product-thumb-info-act">
                                                        <a href="javascript:void(0);" data-toggle="modal"
                                                            data-target=".quickview-wrapper" class="view-product">
                                                            <span><i class="fa fa-external-link"></i></span>
                                                        </a>
                                                        <a href="shop-cart-full.html" class="add-to-cart-product">
                                                            <span><i class="fa fa-shopping-cart"></i></span>
                                                        </a>
                                                    </span>
                                                    <a href="{{ route('client.product_detail', $product->id) }}">
                                                        <img alt="" class="img-responsive"
                                                            src="{{ $product->image }}">
                                                    </a>
                                                </div>
                                                <div class="product-thumb-info-content">
                                                    <span class="price pull-right">{{ $product->price_regular }}
                                                        USD</span>
                                                    <h4><a href="shop-product-detail2.html">{{ $product->name }}</a></h4>
                                                    <span class="item-cat"><small><a
                                                                href="#">{{ $product->category->name }}</a></small></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End New Products -->

        <!-- Begin Parallax -->
        <section class="pi-parallax" data-stellar-background-ratio="0.6">
            <div class="container">
                <div id="owl-text-slide" class="owl-carousel">
                    <div class="item">
                        <blockquote>
                            <p>Design is a funny word. Some people think design means how it looks. But of course, if you
                                dig deeper, it’s really how it works.</p>
                            <footer>by <cite title="Steve Jobs">Steve Jobs</cite></footer>
                        </blockquote>
                    </div>
                    <div class="item">
                        <blockquote>
                            <p>They may forget what you said, but they will never forget how you made them feel.</p>
                            <footer>by <cite title="Steve Jobs">Carl W. Buechner</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Parallax -->

        <!-- Begin Latest Blogs -->
        <section class="latest-blog">
            <div class="container">
                <h2 class="title"><span>Latest from the blog</span></h2>
                <div class="row">
                    @foreach ($latest_posts as $post)
                        <div class="col-xs-6 animation">
                            <article class="post">
                                <div class="post-image">
                                    <span class="post-info-act">
                                        <a href="blog-single.html"><i class="fa fa-caret-right"></i></a>
                                    </span>
                                    <img class="img-responsive" src="{{ $post->image }}"
                                        alt="Blog">
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
    </div>
@endsection
