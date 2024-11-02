@extends('client.layouts.master')

@section('title')
{{ $product->name }}
@endsection

@section('css')
    <style>
        span.stock {
            margin-left: 15px;
            line-height: 50px;
        }
    </style>
@endsection

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
                    <li><a href="#">&laquo; Trước</a></li>
                    <li><a href="#">Sau &raquo;</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End page top -->

    <div class="container">
        <div class="row">
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
                        <span class="amount">{{ number_format($product->price_regular, 0, ',', '.') }} VND</span>
                    </p>

                    <div>
                        <form method="post" class="cart" id="addToCart">
                            @csrf
                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                            <input type="hidden" id="stock" value="">

                            <ul class="list-inline list-select clearfix">
                                <li>
                                    <h4 class="m-0">Size:</h4>
                                </li>

                                <li id="size-btn">
                                    @foreach ($product->variants->unique('size') as $item)
                                        <button class="btn-size mr-1"
                                            data-size-id="{{ $item->size->id }}">{{ $item->size->name }}</button>
                                    @endforeach
                                </li>
                            </ul>
                            <ul class="list-inline list-select clearfix">
                                <li>
                                    <h4 class="m-0">Màu:</h4>
                                </li>

                                <li id="color-btn">
                                    @foreach ($product->variants->unique('color') as $item)
                                        <button class="btn-color mr-1" data-color-id="{{ $item->color->id }}"
                                            style="background-color:{{ $item->color->code_color }}"></button>
                                    @endforeach
                                </li>
                            </ul>

                            <div class="quantity pull-left">
                                <input type="button" class="minus" value="-">
                                <input type="text" class="input-text qty" title="Qty" value="1" id="quantity"
                                    name="quantity" step="1">
                                <input type="button" class="plus" value="+">
                                <span><span class="stock">{{ $sumStock }}</span> hàng có sẵn</span>
                            </div>

                            <a href="#" class="btn btn-grey">
                                <span><i class="fa fa-heart"></i></span>
                            </a>

                            <button type="submit" class="btn btn-primary btn-icon">
                                <i class="fa fa-shopping-cart"></i> Add to cart
                            </button>
                        </form>
                    </div>

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
                        {{-- <div class="panel panel-default">
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
                        </div> --}}
                        <!-- Đánh giá sản phẩm -->
                        {{-- <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseReviews">
                                        Reviews ({{ $product->reviews->count() }})
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseReviews" class="panel-collapse collapse">
                                <div class="panel-body post-comments">
                                    <ul class="comments">
                                        @foreach ($product->reviews as $review)
                                            <li>
                                                <div class="comment">
                                                    <div class="img-circle">
                                                        <img class="avatar" width="50" alt="User Avatar" src="{{ $review->user->user_image ? asset('storage/' . $review->user->user_image) : '/assets/client/images/default-avatar.png' }}">
                                                    </div>
                                                    <div class="comment-block">
                                                        <span class="comment-by">
                                                            <strong>{{ $review->user->name }}</strong>
                                                        </span>
                                                        <span class="date">
                                                            <small><i class="fa fa-clock-o"></i>
                                                                {{ $review->created_at->format('F d, Y') }}</small>
                                                        </span>
                                                        <div class="rating">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i class="fa{{ $i <= $review->rating ? ' fa-star' : ' fa-star-o' }}"
                                                                    aria-hidden="true"></i>
                                                            @endfor
                                                        </div>
                                                        <p>{{ $review->review }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Reviews ({{ $product->reviews->count() }})</a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body post-comments">
                                    <ul class="comments">
                                        @foreach ($product->reviews as $review)
                                            <li>
                                                <div class="comment">
                                                    <div class="img-circle">
                                                        <img class="avatar" width="50" alt="" src="/assets/client/images/content/blog/avatar.png">
                                                    </div>
                                                    <div class="comment-block">
                                                        <span class="comment-by">
                                                            <strong>{{ $review->user->name }}</strong>
                                                        </span>
                                                        <span class="date">
                                                            <small><i class="fa fa-clock-o"></i> {{ $review->created_at->format('F d, Y') }}</small>
                                                        </span>
                                                        <p>{{ $review->review }}</p>
                                                        <span>Rating: {{ $review->rating }}/5</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Form đánh giá chỉ hiện khi người dùng có quyền đánh giá -->
                        @if ($canReview)
                            <form action="{{ route('client.reviews.store', $product->id) }}" method="POST">
                                @csrf
                                <textarea name="review" placeholder="Nhập đánh giá của bạn" required></textarea>
                                <input type="number" name="rating" min="1" max="5" placeholder="Đánh giá (1-5)" required>
                                <button type="submit">Gửi đánh giá</button>
                            </form>
                        @else
                            <p>Bạn cần mua sản phẩm này để có thể đánh giá.</p>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin Related Products -->
    <section class="products-slide">
        <div class="container">
            <h2 class="title"><span>Sản Phẩm Liên Quan</span></h2>
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
                                            <span class="price pull-right">{{ number_format($item->price_regular, 0, ',', '.') }}
                                                VND
                                            </span>
                                            <h4>
                                                <a
                                                    href="{{ route('client.product.show', $item->id) }}">{{ $item->name }}</a>
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

@section('js')
    <script>
        $(document).ready(function() {
            let selectedColor = null;
            let selectedSize = null;
            let stock = $('#stock').val();

            $('#color-btn').on('click', '.btn-color', function(e) {
                e.preventDefault();
                $('.btn-color').removeClass('color-active');
                $(this).addClass('color-active');

                selectedColor = $(this).data('color-id');
                getInStock(selectedSize, selectedColor);
            });

            $('#size-btn').on('click', '.btn-size', function(e) {
                e.preventDefault();
                $('.btn-size').removeClass('btn-active');
                $(this).addClass('btn-active');

                selectedSize = $(this).data('size-id');
                getInStock(selectedSize, selectedColor);

                fetchAvailableColors(selectedSize);
            });

            $('#addToCart').on('submit', function(e) {
                e.preventDefault();
                let productId = $('#product_id').val();
                let quantity = $('#quantity').val();
                let dataCart = {
                    product_id: productId,
                    color_id: selectedColor,
                    size_id: selectedSize,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}',
                }

                if (selectedColor && selectedSize) {
                    $.post("{{ route('client.carts.add') }}", dataCart, function(res) {
                        if (res.status_code == 200) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top",
                                showConfirmButton: false,
                                timer: 2500,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "success",
                                title: `<span style="font-size: 1.5rem">${res.message}</span>`,
                                width: 450
                            });

                            load_header();
                        } else {
                        console.log(res.errors);

                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: res.message,
                            });
                        }
                    })
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Vui lòng chọn phân loại!",
                    });
                }
            });

            function fetchAvailableColors(sizeId) {
                let productId = $('#product_id').val();
                let dataColor = {
                    product_id: productId,
                    size_id: sizeId
                }
                $.get("{{ route('get.color') }}", dataColor, function(res) {
                    $('.btn-color').hide();

                    res.forEach(item => {
                        $(`.btn-color[data-color-id="${item.color_id}"]`).show();
                    });
                });
            }

            function getInStock(sizeId = null, colorId = null) {
                let productId = $('#product_id').val();

                data = {
                    product_id: productId,
                    size_id: sizeId,
                    color_id: colorId,
                }

                $.get("{{ route('get.stock') }}", data, function(res) {
                    if (Array.isArray(res)) {
                        res.forEach(item => {
                            $('.stock').text(item.stock);
                            $('.amount').text(item.price + ' VND');
                        });
                    } else {
                        $('.stock').text(res);
                        $('#stock').val(res);
                    }
                })
            }
        });
    </script>
@endsection
