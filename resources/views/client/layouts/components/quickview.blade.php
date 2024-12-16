<!-- Begin Quickview -->
<div class="modal fade quickview-wrapper" tabindex="-1" role="dialog" aria-hidden="true" id="productModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                    class="sr-only">Close</span></button>
            <div class="product-detail">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="product-preview">
                            <ul class="bxslider" id="slider1">
                                <li>
                                    <img alt="" class="img-responsive" id="product-image" src="">
                                </li>

                                <div class="image-others">
                                    
                                </div>
                            </ul>

                            <ul class="list-inline bx-pager image-slides">
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="summary entry-summary">

                            <h3 id="product-name"></h3>

                            <div class="reviews-counter clearfix">
                                <div class="rating five-stars pull-left">
                                    <div class="star-rating"></div>
                                    <div class="star-bg"></div>
                                </div>
                                <span id="review-count">0 Đánh giá</span>
                            </div>

                            <div class="reviews-counter clearfix">
                               
                                <span id="product-views"></span></span><span> lượt xem</span>
                            </div>

                            <p class="price">
                                <span class="amount" id="product-price-regular">
                            </p>

                            <form method="post" class="cart" id="addToCartQuick">
                                @csrf
                                <input type="hidden" class="product_id" value="">

                                <ul class="list-inline list-select clearfix">
                                    <li>
                                        <h4 class="m-0">Size:</h4>
                                    </li>

                                    <li id="size-quick">

                                    </li>
                                </ul>

                                <ul class="list-inline list-select clearfix">
                                    <li>
                                        <h4 class="m-0">Màu sắc:</h4>
                                    </li>

                                    <li id="color-quick">

                                    </li>
                                </ul>

                                <div>
                                    <span class="stock"></span> hàng có sẵn
                                </div>

                                <div class="quantity">
                                    <input type="button" class="minus" value="-">
                                    <input type="text" class="input-text qty" title="Qty" value="1"
                                        id="quantity" name="quantity" min="1" step="1">
                                    <input type="button" class="plus" value="+">
                                </div>


                                <button type="submit" class="btn btn-primary btn-icon">
                                    <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                </button>
                            </form>

                            <ul class="list-unstyled product-meta">
                                <li>SKU: <span id="product-sku"></span></li>
                                <li>Categories:
                                    <a href="#" id="category-name"></a>
                                    <a href="#" id="category-type"></a>
                                </li>
                            </ul>

                            <div class="panel-group" id="accordion">
                                {{-- Description --}}
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseOne">Description</a> </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <p id="product-description"></p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Addition Information --}}
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseTwo">Addition Information</a> </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p id="product-content"></p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Reviews --}}
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseReviews">
                                                Reviews (<span id="reviewCount">0</span>)
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseReviews" class="panel-collapse collapse">
                                        <div class="panel-body post-comments">
                                            <ul class="comments" id="reviewsList">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Quickview -->
