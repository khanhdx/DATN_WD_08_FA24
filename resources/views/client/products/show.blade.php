@extends('client.layouts.master')

@section('content')
    <!-- Begin page top -->
    <section class="page-top">
        <div class="container">
            <div class="page-top-in">
                <ol class="breadcrumb pull-left">
                    <li><a href="#">{{ $product->category->type }}</a></li>
                    <li><a href="#">{{ $product->category->name }}</a></li>
                    <li class="active">{{ $product->name }}</li>
                </ol>
                <ul class="pager pull-right">
                    <li><a href="#">&laquo; Previous</a></li>
                    <li><a href="#">Next &raquo;</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End page top -->

    <div class="container">
        <div class="row">
            @if (session()->has('success') && session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="col-sm-6">
                <div class="product-preview">
                    <div class="flexslider">
                        <ul class="slides">
                            <li data-thumb="{{ $product->image }}">
                                <img src="{{ $product->image }}" alt="">
                            </li>
                            <li data-thumb="/assets/client/images/content/products/product-1-1.jpg">
                                <img src="/assets/client/images/content/products/product-1-1.jpg" alt="">
                            </li>
                            <li data-thumb="/assets/client/images/content/products/product-1-2.jpg">
                                <img src="/assets/client/images/content/products/product-1-2.jpg" alt="">
                            </li>
                            <li data-thumb="/assets/client/images/content/products/product-1-3.jpg">
                                <img src="/assets/client/images/content/products/product-1-3.jpg" alt="">
                            </li>
                            <li data-thumb="/assets/client/images/content/products/product-1-4.jpg">
                                <img src="/assets/client/images/content/products/product-1-4.jpg" alt="">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="summary entry-summary">

                    <h3>{{ $product->name }}</h3>

                    <div class="reviews-counter clearfix">
                        <div class="rating five-stars pull-left">
                            <div class="star-rating"></div>
                            <div class="star-bg"></div>
                        </div>
                        <span>3 Reviews</span>
                    </div>

                    <p class="price">
                        <span class="amount">${{ $product->price_regular }}</span>
                    </p>

                    <form method="post" class="cart" action="{{ route('client.carts.add') }}">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <ul class="list-inline list-select clearfix">
                            <li>
                                <select class="formDropdown" name="size_id">
                                    <option>Select Size</option>
                                    @foreach ($product->variants->unique('size') as $item)
                                        <option value="{{ $item->size->id }}">{{ $item->size->name }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>
                                <select class="formDropdown" name="color_id">
                                    <option>Select Color</option>
                                    @foreach ($product->variants->unique('color') as $item)
                                        <option value="{{ $item->color->id }}"
                                            style="background-color:{{ $item->color->code_color }}">
                                            {{ $item->color->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </li>
                        </ul>

                        <div class="quantity pull-left">
                            <input type="button" class="minus" value="-">
                            <input type="text" class="input-text qty" title="Qty" value="1" name="quantity" min="1" step="1">
                            <input type="button" class="plus" value="+">
                        </div>
                        <a href="#" class="btn btn-grey">
                            <span><i class="fa fa-heart"></i></span>
                        </a>
                        <button type="submit" class="btn btn-primary btn-icon">
                            <i class="fa fa-shopping-cart"></i> Add to cart
                        </button>

                    </form>

                    <ul class="list-unstyled product-meta">
                        <li>SKU: {{ $product->SKU }}</li>
                        <li>Categories:
                            <a href="#">{{ $product->category->name }}</a>
                            <a href="#">{{ $product->category->type }}</a>
                        </li>
                    </ul>

                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseOne">Description</a> </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <p>
                                        {{ $product->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseTwo">Addition Information</a> </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>
                                        {{ $product->content }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseThree">Reviews (3)</a> </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body post-comments">
                                    <ul class="comments">
                                        <li>
                                            <div class="comment">
                                                <div class="img-circle"> <img class="avatar" width="50"
                                                        alt=""
                                                        src="/assets/client/images/content/blog/avatar.png"> </div>
                                                <div class="comment-block">
                                                    <span class="comment-by"> <strong>Frank Reman</strong></span>
                                                    <span class="date"><small><i class="fa fa-clock-o"></i> January
                                                            12, 2013</small></span>
                                                    <p>Lorem ipsum dolor sit amet.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="comment">
                                                <div class="img-circle"> <img class="avatar" width="50"
                                                        alt=""
                                                        src="/assets/client/images/content/blog/avatar.png"> </div>
                                                <div class="comment-block">
                                                    <span class="comment-by"> <strong>Frank Reman</strong></span>
                                                    <span class="date"><small><i class="fa fa-clock-o"></i> July 11,
                                                            2014</small></span>
                                                    <p>Nam viverra euismod odio, gravida pellentesque urna varius vitae,
                                                        gravida pellentesque urna varius vitae</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="comment">
                                                <div class="img-circle"> <img class="avatar" width="50"
                                                        alt=""
                                                        src="/assets/client/images/content/blog/avatar.png"> </div>
                                                <div class="comment-block">
                                                    <span class="comment-by"> <strong>Frank Reman</strong></span>
                                                    <span class="date"><small><i class="fa fa-clock-o"></i> July 11,
                                                            2014</small></span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Begin Related Products -->
    <section class="products-slide">
        <div class="container">
            <h2 class="title"><span>Related Products</span></h2>
            <div class="row">
                <div id="owl-product-slide" class="owl-carousel product-slide">
                    @foreach ($related_products as $item)
                        @if ($item->category->name == $product->category->name && $product->id != $item->id)
                            <div class="col-md-12">
                                <div class="item product">
                                    <div class="product-thumb-info">

                                        <div class="product-thumb-info-image">
                                            <span class="product-thumb-info-act">
                                                <a href="" data-toggle="modal" data-target=".quickview-wrapper"
                                                    class="view-product" data-id="{{ $item->id }}">
                                                    <span><i class="fa fa-external-link"></i></span>
                                                </a>
                                                <a href="shop-cart-full.html" class="add-to-cart-product">
                                                    <span><i class="fa fa-shopping-cart"></i></span>
                                                </a>
                                            </span>
                                            <a href="{{ route('client.product.show', $item->id) }}">
                                                <img alt="" class="img-responsive" src="{{ $item->image }}">
                                            </a>
                                        </div>

                                        <div class="product-thumb-info-content">
                                            <span class="price pull-right">{{ $item->price_regular }}
                                                USD
                                            </span>
                                            <h4>
                                                <a href="shop-product-detail2.html">{{ $item->name }}</a>
                                            </h4>
                                            <span class="item-cat">
                                                <small>
                                                    <a href="#">{{ $item->category->name }}</a>
                                                </small>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- End Top Selling -->
@endsection