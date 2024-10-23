@extends('client.layouts.master')

@section('text_page')
    Shop - Sidebar
@endsection

@section('content')
    @include('client.layouts.components.pagetop', ['md' => 'md'])

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <aside class="sidebar">
                    <aside class="block filter-blk">
                        <h4>Filter By Price</h4>
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
                        <h4>Category</h4>
                        <ul class="list-unstyled list-cat">
                            <li><a href="#">New</a></li>
                            <li><a href="#">Tops</a></li>
                            <li><a href="#">Bottoms</a></li>
                            <li><a href="#">Denim</a></li>
                            <li><a href="#">Outerwear</a></li>
                            <li><a href="#">Shoes</a></li>
                            <li><a href="#">Jackets</a></li>
                            <li><a href="#">Accessories</a></li>
                        </ul>
                    </aside>
                    <aside class="block blk-brands">
                        <h4>Brands</h4>
                        <ul class="list-unstyled list-cat">
                            <li><a href="#">Louis Vuitton</a></li>
                            <li><a href="#">Gucci</a></li>
                            <li><a href="#">Levi’s</a></li>
                            <li><a href="#">Prada</a></li>
                            <li><a href="#">Dolce & Gabbana</a></li>
                            <li><a href="#">Dior</a></li>
                            <li><a href="#">Burberry</a></li>
                        </ul>
                    </aside>
                    <aside class="block blk-colors">
                        <h4>Colors</h4>
                        <ul class="list-unstyled list-cat">
                            <li><a href="#">Black</a></li>
                            <li><a href="#">Blue</a></li>
                            <li><a href="#">Navy</a></li>
                            <li><a href="#">Pink</a></li>
                            <li><a href="#">Purple</a></li>
                            <li><a href="#">Old Navy</a></li>
                        </ul>
                    </aside>
                    <aside class="block featured">
                        <h4>Featured</h4>
                        <ul class="list-unstyled list-thumbs-pro">
                            <li class="product">
                                <div class="product-thumb-info">
                                    <div class="product-thumb-info-image">
                                        <a href="shop-product-detail1.html"><img alt="" width="60"
                                                src="images/content/products/product-7.jpg"></a>
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
                                                src="images/content/products/product-8.jpg"></a>
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
                                                src="images/content/products/product-9.jpg"></a>
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
                <!-- Begin Lookbook Women -->
                <section id="lookbook">
                    <div class="lookbook">
                        <h2><a href="#">Lookbook Women</a></h2>
                        <p>Etiam aliquam risus ante, quis ultrices enim porta a. Integer et dolor sit amet enim feugiat
                            faucibus. Donec sit amet egestas orci. Proin facilisis mi ornare turpis sollicitudin; vel rutrum
                            est viverra. Vestibulum hendrerit egestas semper.</p>
                    </div>
                </section>
                <!-- End Lookbook Women -->

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

                    <div class="row">
                        <div class="col-xs-4 animation">
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
                                        <img alt="" class="img-responsive"
                                            src="images/content/products/product-1.jpg">
                                    </div>
                                    <div class="product-thumb-info-content">
                                        <span class="price pull-right">29.99 USD</span>
                                        <h4><a href="shop-product-detail2.html">Denim shirt</a></h4>
                                        <span class="item-cat"><small><a href="#">Jackets</a></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 animation">
                            <div class="product">
                                <a href="shop-product-detail1.html">
                                    <span class="bag bag-hot">Hot</span>
                                </a>
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
                                        <img alt="" class="img-responsive"
                                            src="images/content/products/product-2.jpg">
                                    </div>
                                    <div class="product-thumb-info-content">
                                        <span class="price pull-right">29.99 USD</span>
                                        <h4><a href="shop-product-detail2.html">Poplin shirt with fine pleated bands</a>
                                        </h4>
                                        <span class="item-cat"><small><a href="#">Shirts</a></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 animation">
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
                                        <img alt="" class="img-responsive"
                                            src="images/content/products/product-3.jpg">
                                    </div>
                                    <div class="product-thumb-info-content">
                                        <span class="price pull-right">29.99 USD</span>
                                        <h4><a href="shop-product-detail2.html">Contrasting shirt</a></h4>
                                        <span class="item-cat"><small><a href="#">Stock clearance</a></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-xs-4 animation">
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
                                        <img alt="" class="img-responsive"
                                            src="images/content/products/product-9.jpg">
                                    </div>
                                    <div class="product-thumb-info-content">
                                        <span class="price pull-right">69.99 USD</span>
                                        <h4><a href="shop-product-detail2.html">Classic blazer</a></h4>
                                        <span class="item-cat"><small><a href="#">Outerwear</a></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 animation">
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
                                        <img alt="" class="img-responsive"
                                            src="images/content/products/product-10.jpg">
                                    </div>
                                    <div class="product-thumb-info-content">
                                        <span class="price pull-right">39.99 USD</span>
                                        <h4><a href="shop-product-detail2.html">Striped full skirt</a></h4>
                                        <span class="item-cat"><small><a href="#">Skirts</a></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 animation">
                            <div class="product">
                                <a href="shop-product-detail1.html">
                                    <span class="bag bag-onsale">Sale</span>
                                </a>
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
                                        <img alt="" class="img-responsive"
                                            src="images/content/products/product-11.jpg">
                                    </div>
                                    <div class="product-thumb-info-content">
                                        <span class="price pull-right">79.99 USD</span>
                                        <h4><a href="shop-product-detail2.html">Structured double-breasted blazer</a></h4>
                                        <span class="item-cat"><small><a href="#">Outerwear</a></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-xs-4 animation">
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
                                        <img alt="" class="img-responsive"
                                            src="images/content/products/product-17.jpg">
                                    </div>
                                    <div class="product-thumb-info-content">
                                        <span class="price pull-right">59.99 USD</span>
                                        <h4><a href="shop-product-detail2.html">Gold chrono watch</a></h4>
                                        <span class="item-cat"><small><a href="#">Accessories</a></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 animation">
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
                                        <img alt="" class="img-responsive"
                                            src="images/content/products/product-18.jpg">
                                    </div>
                                    <div class="product-thumb-info-content">
                                        <span class="price pull-right">7.99 USD</span>
                                        <h4><a href="shop-product-detail2.html">Long earrings</a></h4>
                                        <span class="item-cat"><small><a href="#">Accessories</a></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 animation">
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
                                        <img alt="" class="img-responsive"
                                            src="images/content/products/product-19.jpg">
                                    </div>
                                    <div class="product-thumb-info-content">
                                        <span class="price pull-right">19.99 USD</span>
                                        <h4><a href="shop-product-detail2.html">Braided belt</a></h4>
                                        <span class="item-cat"><small><a href="#">Belts</a></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <ul class="pagination">
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
@endsection
