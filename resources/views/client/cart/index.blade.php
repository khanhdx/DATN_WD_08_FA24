@extends('client.layouts.master')

@section('text_page')
    Shopping Bag
@endsection

@section('content')
    @include('client.layouts.components.pagetop')
    <div class="container">
        <div class="row featured-boxes">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if (session()->has('errors'))
                <div class="alert alert-danger">
                    {{ session()->get('errors') }}
                </div>
            @endif

            <div class="col-md-12">
                <h3>Your selection ({{ Auth::check() ? count($carts->toArray()) : count($carts) }} items)</h3>
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
                                @foreach ($carts as $key => $cart)
                                    <tr class="cart_table_item">
                                        <td class="product-thumbnail">
                                            <a href="shop-product-sidebar.html">
                                                <img alt="" width="80"
                                                    src="{{ Auth::check() ? $cart->product_variant->product->image : $cart['image'] }}">
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="shop-product-sidebar.html">
                                                {{ Auth::check() ? $cart->product_variant->product->name : $cart['name'] }}
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="shop-product-sidebar.html">
                                                {{ Auth::check() ? $cart->product_variant->color->name : $cart['color'] }},
                                                {{ Auth::check() ? $cart->product_variant->size->name : $cart['size'] }}
                                            </a>
                                        </td>
                                        <td class="product-price">
                                            <span
                                                class="amount">${{ Auth::check() ? $cart->product_variant->price : $cart['price'] }}</span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <form
                                                    action="{{ route('client.cart.update', Auth::check() ? $cart->id : $key) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="product_variant_id"
                                                        value="{{ Auth::check() ? $cart->product_variant_id : $key }}">
                                                    <input type="button" class="minus" value="-" id="decrease">
                                                    <input type="text" class="input-text qty text" title="Qty"
                                                        id="quantity"
                                                        value="{{ Auth::check() ? $cart->quantity : $cart['quantity'] }}"
                                                        name="quantity" min="1" step="1">
                                                    <input type="button" class="plus" value="+" id="increase">
                                                    <button type="submit" class="btn btn-xs">Confirm</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span
                                                class="amount">${{ Auth::check() ? $cart->price : $total }}</span>
                                        </td>
                                        <td class="product-remove">
                                            <form
                                                action="{{ route('client.cart.delete', Auth::check() ? $cart->id : $key) }}"
                                                method="post" id="form{{ $loop->iteration }}">
                                                @csrf
                                                @method('DELETE')

                                                <a title="Remove this item" class="remove submitLink"
                                                    data-form="form{{ $loop->iteration }}" href="#">
                                                    <i class="fa fa-times-circle"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
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
                        {{-- <a href="{{ route('') }}"><input type="submit" value="Update Shopping Bag" class="btn btn-default btn-block btn-sm"
                                data-loading-text="Loading..."></a> --}}
                        <a href="{{ route('client.home') }}"><input type="submit" value="Proceed To checkout"
                                class="btn btn-primary btn-block btn-sm" data-loading-text="Loading..."></a>
                        <a href="{{ route('client.product.index') }}"><input type="submit" value="Continue Shopping" class="btn btn-grey btn-block btn-sm"
                                data-loading-text="Loading..."></a>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
