@extends('client.layouts.master')

@section('text_page')
    Shopping Bag
@endsection

@section('content')
    @include('client.layouts.components.pagetop')
<div class="container">
    <div class="row featured-boxes">
        <div class="col-md-12">
            <h3>Your selection (3 items)</h3>
            <div class="featured-box featured-box-cart">
                <div class="box-content">
                    <form method="post" action="#">
                        <table cellspacing="0" class="shop_table" width="100%">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">
                                        Item
                                    </th>
                                    <th class="product-name">
                                        Product name
                                    </th>
                                    <th class="product-price">
                                        Price
                                    </th>
                                    <th class="product-quantity">
                                        Quantity
                                    </th>
                                    <th class="product-subtotal">
                                        SubTotal
                                    </th>
                                    <th class="product-remove">
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="cart_table_item">
                                    
                                    <td class="product-thumbnail">
                                        <a href="shop-product-sidebar.html">
                                            <img alt="" width="80" src="images/content/products/product-thumb.jpg">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="shop-product-sidebar.html">Linen shirt with ribbon at the front</a>
                                    </td>
                                    <td class="product-price">
                                        <span class="amount">$299</span>
                                    </td>
                                    <td class="product-quantity">
                                        
                                            <div class="quantity">
                                                <input type="button" class="minus" value="-">
                                                <input type="text" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                                <input type="button" class="plus" value="+">
                                            </div>
                                        
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="amount">$299</span>
                                    </td>
                                    <td class="product-remove">
                                        <a title="Remove this item" class="remove" href="#">
                                            <i class="fa fa-times-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="cart_table_item">
                                    
                                    <td class="product-thumbnail">
                                        <a href="shop-product-sidebar.html">
                                            <img alt="" width="80" src="images/content/products/product-thumb-1.jpg">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="shop-product-sidebar.html">Poplin shirt with fine pleated bands</a>
                                    </td>
                                    <td class="product-price">
                                        <span class="amount">$72</span>
                                    </td>
                                    <td class="product-quantity">
                                        <form enctype="multipart/form-data" method="post">
                                            <div class="quantity">
                                                <input type="button" class="minus" value="-">
                                                <input type="text" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                                <input type="button" class="plus" value="+">
                                            </div>
                                        </form>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="amount">$72</span>
                                    </td>
                                    <td class="product-remove">
                                        <a title="Remove this item" class="remove" href="#">
                                            <i class="fa fa-times-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="cart_table_item">
                                    
                                    <td class="product-thumbnail">
                                        <a href="shop-product-sidebar.html">
                                            <img alt="" width="80" src="images/content/products/product-thumb-4.jpg">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="shop-product-sidebar.html">Contrasting shirt</a>
                                    </td>
                                    <td class="product-price">
                                        <span class="amount">$60</span>
                                    </td>
                                    <td class="product-quantity">
                                        <form enctype="multipart/form-data" method="post">
                                            <div class="quantity">
                                                <input type="button" class="minus" value="-">
                                                <input type="text" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                                <input type="button" class="plus" value="+">
                                            </div>
                                        </form>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="amount">$60</span>
                                    </td>
                                    <td class="product-remove">
                                        <a title="Remove this item" class="remove" href="#">
                                            <i class="fa fa-times-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    
                </form></div>
            </div>
        </div>
    </div>

    <div class="row featured-boxes">
        <div class="col-xs-4">
            <div class="featured-box featured-box-secondary">
                <div class="box-content">
                    <h4>Promotional Code</h4>
                    <p>Enter promotional code if you have one</p>
                    <form action="#" id="" type="post">
                        <div class="form-group">
                            <label class="sr-only">Promotional code</label>
                            <input type="text" value="" class="form-control" placeholder="Enter promotional code here">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Apply Promotion" class="btn btn-grey btn-sm" data-loading-text="Loading...">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="featured-box featured-box-secondary">
                <div class="box-content">
                    <h4>Calculate Shipping</h4>
                    <p>Enter your destination to get a shipping estimate.</p>
                    <form action="#" id="" type="post">
                        <div class="form-group">
                            <label class="sr-only">Country</label>
                            <div class="list-sort">
                                <select class="formDropdown">
                                    <option value="">Select a country</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="sr-only">State/Province</label>
                            <input type="text" value="" class="form-control" placeholder="State/Province">
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Zip/Postal Code</label>
                            <input type="text" value="" class="form-control" placeholder="Zip/Postal Code">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update Totals" class="btn btn-grey btn-sm" data-loading-text="Loading...">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="featured-box featured-box-secondary">
                <div class="box-content">
                    <h4>Shopping bag summary</h4>
                    <table cellspacing="0" class="cart-totals" width="100%">
                        <tbody>
                            <tr class="cart-subtotal">
                                <th>
                                    Cart Subtotal
                                </th>
                                <td>
                                    <span class="amount">$431</span>
                                </td>
                            </tr>
                            <tr class="shipping">
                                <th>
                                    Shipping
                                </th>
                                <td>
                                    Free Shipping<input type="hidden" value="free_shipping" id="shipping_method" name="shipping_method">
                                </td>
                            </tr>
                            <tr class="total">
                                <th>
                                    Total
                                </th>
                                <td>
                                    <span class="amount">$431</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p><input type="submit" value="Update Shopping Bag" class="btn btn-default btn-block btn-sm" data-loading-text="Loading..."></p>
                    <p><input type="submit" value="Proceed To checkout" class="btn btn-primary btn-block btn-sm" data-loading-text="Loading..."></p>
                    <p><input type="submit" value="Continue Shopping" class="btn btn-grey btn-block btn-sm" data-loading-text="Loading..."></p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection