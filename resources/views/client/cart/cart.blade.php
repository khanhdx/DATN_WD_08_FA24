@if (count($cartItems) == 0)
    <div class="row featured-boxes">
        <div class="col-xs-5">
            <h4>Không có sản phẩm nào trong giỏ hàng của bạn.</h4>
            <a href="{{ route('client.home') }}">
                <input type="submit" value="Tiếp tục mua sắm" class="btn btn-grey btn-block btn-sm"
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
                                            <a href="{{ route('client.product.show', $cart->productVariant->product->id) }}">
                                                <img alt="" width="80"
                                                    src="{{ $cart->productVariant->product->image }}">
                                            </a>
                                        </td>

                                        <td class="product-name">
                                            <a href="{{ route('client.product.show', $cart->productVariant->product->id) }}">
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
        {{-- <div class="col-xs-4">
            <div class="featured-box featured-box-secondary">
                <div class="box-content">
                    <h4>Tính toán vận chuyển</h4>
                    <p>Nhập điểm đến của bạn để có được ước tính vận chuyển.</p>

                    <!-- Phản hồi từ server -->
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @elseif (session('shipping_fee'))
                        <div class="alert alert-success">
                            Giá vận chuyển: {{ session('shipping_fee') }} VND
                        </div>
                    @endif

                    <form action="{{ route('client.carts.calculate-shipping') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="sr-only">Tỉnh / Thành phố</label>
                            <input type="text" name="province" class="form-control" placeholder="Nhập Tỉnh / thành phố"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Nhập Quận / Huyện</label>
                            <input type="text" name="district" class="form-control" placeholder="Nhập Quận / Huyện"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Phường / Xã</label>
                            <input type="text" name="ward" class="form-control" placeholder="Phường / Xã"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Nhập số nhà, tên đường</label>
                            <input type="text" name="address" class="form-control"
                                placeholder="Nhập số nhà, tên đường" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Xác nhận địa chỉ" class="btn btn-grey btn-sm"
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
                                    <span class="amount">{{ number_format($total, 0, ',', '.') }} VND</span>
                                </td>
                            </tr>
                            {{-- <tr class="shipping">
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
                                    @if (session('shipping_fee'))
                                        <span class="amount">{{ number_format($total + str_replace('.', '', session('shipping_fee')), 0, ',', '.') }} VND</span>
                                    @else
                                        <span class="amount">{{ number_format($total, 0, ',', '.') }} VND</span>
                                    @endif
                                </td>
                            </tr> --}}
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
