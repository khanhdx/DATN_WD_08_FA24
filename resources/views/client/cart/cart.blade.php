@if (count($cartItems) == 0)
    <div class="row featured-boxes">
        <div class="col-xs-5">
            <h4>Không có sản phẩm nào trong giỏ hàng của bạn.</h4>
            <a href="{{ route('client.home') }}">
                <input type="submit" value="Continue Shopping" class="btn btn-grey btn-block btn-sm"
                    data-loading-text="Loading...">
            </a>
            <h1></h1>
        </div>
    </div>
@else
    <div class="row featured-boxes">
        <div class="col-md-12">
            <h3>Your selection ({{ Auth::check() ? count($cartItems->toArray()) : count($cartItems) }} items)</h3>
            <div class="featured-box featured-box-cart">
                <div class="box-content">
                    <table cellspacing="0" class="shop_table" width="100%">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">
                                    Item
                                </th>
                                <th class="product-name">
                                    Product name
                                </th>
                                <th class="product-name">
                                    Variants
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
                            @foreach ($cartItems as $key => $cart)
                                @if (Auth::check())
                                    <tr class="cart_table_item">
                                        <td class="product-thumbnail">
                                            <a href="shop-product-sidebar.html">
                                                <img alt="" width="80"
                                                    src="{{ $cart->productVariant->product->image }}">
                                            </a>
                                        </td>

                                        <td class="product-name">
                                            <a href="shop-product-sidebar.html">
                                                {{ $cart->productVariant->product->name }}
                                            </a>
                                        </td>

                                        <td class="product-name">
                                            <a href="shop-product-sidebar.html">
                                                {{ $cart->productVariant->color->name }},
                                                {{ $cart->productVariant->size->name }}
                                            </a>
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">${{ $cart->productVariant->price }}</span>
                                        </td>

                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <form method="post">
                                                    @csrf

                                                    <input type="hidden" name="product_variant_id"
                                                        value="{{ $cart->productVariant->id }}">

                                                    <input type="button" class="minus" value="-"
                                                        data-id="{{ $cart->id }}"
                                                        data-variant-id="{{ $cart->productVariant->id }}">

                                                    <input type="text" class="input-text qty text"
                                                        value="{{ $cart->quantity }}" name="quantity" min="1"
                                                        step="1" data-id="{{ $cart->id }}"
                                                        data-variant-id="{{ $cart->productVariant->id }}">

                                                    <input type="button" class="plus" value="+"
                                                        data-id="{{ $cart->id }}"
                                                        data-variant-id="{{ $cart->productVariant->id }}">
                                                </form>
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount sub-total-{{ $cart->id }}">
                                                ${{ $cart->sub_total }}
                                            </span>
                                        </td>

                                        <td class="product-remove">
                                            <form method="post">
                                                @csrf
                                                <a title="Remove this item" class="remove-cart"
                                                    href="{{ route('client.carts.delete', $cart->id) }}">
                                                    <i class="fa fa-times-circle"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @else
                                    <tr class="cart_table_item">
                                        <td class="product-thumbnail">
                                            <a href="shop-product-sidebar.html">
                                                <img alt="" width="80" src="{{ $cart['image'] }}">
                                            </a>
                                        </td>

                                        <td class="product-name">
                                            <a href="shop-product-sidebar.html">
                                                {{ $cart['name'] }}
                                            </a>
                                        </td>

                                        <td class="product-name">
                                            <a href="shop-product-sidebar.html">
                                                {{ $cart['color'] }},
                                                {{ $cart['size'] }}
                                            </a>
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">${{ $cart['price'] }}</span>
                                        </td>

                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <form method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_variant_id"
                                                        value="{{ $key }}">

                                                    <input type="button" class="minus" value="-"
                                                        data-id="{{ $key }}"
                                                        data-variant-id="{{ $key }}">

                                                    <input type="text" class="input-text qty text" title="Qty"
                                                        value="{{ $cart['quantity'] }}" name="qty" min="1"
                                                        step="1" data-id="{{ $key }}"
                                                        data-variant-id="{{ $key }}">

                                                    <input type="button" class="plus" value="+"
                                                        data-id="{{ $key }}"
                                                        data-variant-id="{{ $key }}">
                                                </form>
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount sub-total-{{ $key }}">
                                                ${{ $cart['sub_total'] }}
                                            </span>
                                        </td>

                                        <td class="product-remove">
                                            <form method="post">
                                                @csrf
                                                <a title="Remove this item" class="remove-cart"
                                                    href="{{ route('client.carts.delete', $key) }}">
                                                    <i class="fa fa-times-circle"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                            <input type="text" value="" class="form-control"
                                placeholder="Enter promotional code here">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Apply Promotion" class="btn btn-grey btn-sm"
                                data-loading-text="Loading...">
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
                            <input type="submit" value="Update Totals" class="btn btn-grey btn-sm"
                                data-loading-text="Loading...">
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
                                    <span class="amount">${{ $total }}</span>
                                </td>
                            </tr>
                            <tr class="shipping">
                                <th>
                                    Shipping
                                </th>
                                <td>
                                    Free Shipping<input type="hidden" value="free_shipping" id="shipping_method"
                                        name="shipping_method">
                                </td>
                            </tr>
                            <tr class="total">
                                <th>
                                    Total
                                </th>
                                <td>
                                    <span class="amount">${{ $total }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>
                        <a href="{{ route('checkout') }}" class="btn btn-primary btn-block btn-sm">
                            Proceed To Checkout
                        </a>
                    </p>
                    <a href="{{ route('client.home') }}">
                        <input type="submit" value="Continue Shopping" class="btn btn-grey btn-block btn-sm"
                            data-loading-text="Loading...">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
