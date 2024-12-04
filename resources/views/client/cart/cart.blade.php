@if (count($cartItems) == 0)
    <div class="container mb-6">
        <div class="row featured-boxes text-center">
            <div class="col-xs-3"></div>
            <div class="col-xs-6">
                <h4>Không có sản phẩm nào trong giỏ hàng của bạn!!!</h4>
                <a href="{{ route('client.home') }}" class="btn btn-grey btn-block btn-sm">
                    Tiếp tục mua sắm
                </a>
                <div class="col-xs-3"></div>

            </div>
        </div>
    </div>
@else
    <div class="container mb-6">
        <div class="row featured-boxes">
            <div class="col-md-12">
                <h3>Lựa chọn của bạn ({{ Auth::check() ? count($cartItems->toArray()) : count($cartItems) }} mặt hàng)</h3>
                <div class="featured-box featured-box-cart">
                    <div class="box-content">
                        <table cellspacing="0" class="shop_table" width="100%">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail" colspan="2">
                                        Sản phẩm
                                    </th>
                                    {{-- <th class="product-name">
                                    Product name
                                </th> --}}
                                    <th class="product-name">
                                        Phân loại
                                    </th>
                                    <th class="product-price">
                                        Đơn giá
                                    </th>
                                    <th class="product-quantity">
                                        Số lượng
                                    </th>
                                    <th class="product-subtotal">
                                        Số tiền
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
                                                <a
                                                    href="{{ route('client.product.show', $cart->productVariant->product->id) }}">
                                                    <img alt="" width="80"
                                                        src="{{ $cart->productVariant->product->image }}">
                                                </a>
                                            </td>

                                            <td class="product-name">
                                                <a
                                                    href="{{ route('client.product.show', $cart->productVariant->product->id) }}">
                                                    {{ $cart->productVariant->product->name }}
                                                </a>
                                            </td>

                                            <td class="product-name">
                                                <a href="">
                                                    {{ $cart->productVariant->color->name }},
                                                    {{ $cart->productVariant->size->name }}
                                                </a>
                                            </td>

                                            <td class="product-price">
                                                <span
                                                    class="amount">{{ number_format($cart->productVariant->price, 0, ',', '.') }}
                                                    đ</span>
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
                                                            value="{{ $cart->quantity }}" name="quantity"
                                                            min="1" step="1" data-id="{{ $cart->id }}"
                                                            data-variant-id="{{ $cart->productVariant->id }}">

                                                        <input type="button" class="plus" value="+"
                                                            data-id="{{ $cart->id }}"
                                                            data-variant-id="{{ $cart->productVariant->id }}">
                                                    </form>
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount sub-total-{{ $cart->id }}">
                                                    {{ number_format($cart->sub_total, 0, ',', '.') }} VND
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
                                                <a href="{{ route('client.product.show', $cart['product_id']) }}">
                                                    <img alt="" width="80" src="{{ $cart['image'] }}">
                                                </a>
                                            </td>

                                            <td class="product-name">
                                                <a href="{{ route('client.product.show', $cart['product_id']) }}">
                                                    {{ $cart['name'] }}
                                                </a>
                                            </td>

                                            <td class="product-name">
                                                <a href="">
                                                    {{ $cart['color'] }},
                                                    {{ $cart['size'] }}
                                                </a>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount">{{ number_format($cart['price'], 0, ',', '.') }}
                                                    VND</span>
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
                                                            value="{{ $cart['quantity'] }}" name="qty"
                                                            min="1" step="1" data-id="{{ $key }}"
                                                            data-variant-id="{{ $key }}">

                                                        <input type="button" class="plus" value="+"
                                                            data-id="{{ $key }}"
                                                            data-variant-id="{{ $key }}">
                                                    </form>
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount sub-total-{{ $key }}">
                                                    {{ number_format($cart['sub_total'], 0, ',', '.') }} VND
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
            <p>
                <a href="{{ auth()->check() ? route('checkout') : route('guest.checkout') }}" class="btn btn-primary btn-block btn-sm">
                    Proceed To Checkout
                </a>                
            </p>

            <a href="{{ route('client.home') }}" class="btn btn-grey btn-block btn-sm">
                Tiếp tục mua sắm
            </a>
        </div>
    </div>
@endif
