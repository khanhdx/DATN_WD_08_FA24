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
                            <img alt="" width="80" src="{{ $cart->productVariant->product->image }}">
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
                            <form method="post" class="cartUpdate_{{ $cart->id }}">
                                @csrf

                                <input type="hidden" name="product_variant_id" value="{{ $cart->productVariant->id }}">

                                <input type="button" class="minus" value="-" data-id="{{ $cart->id }}"
                                    data-variant-id="{{ $cart->productVariant->id }}">

                                <input type="text" class="input-text qty text" value="{{ $cart->quantity }}"
                                    name="quantity" min="1" step="1" data-id="{{ $cart->id }}"
                                    data-variant-id="{{ $cart->productVariant->id }}">

                                <input type="button" class="plus" value="+" data-id="{{ $cart->id }}"
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
                            <a title="Remove this item" class="remove"
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

                                <input type="hidden" name="product_variant_id" value="{{ $key }}">

                                <input type="button" class="minus" value="-" data-id="{{ $key }}"
                                    data-variant-id="{{ $key }}">

                                <input type="text" class="input-text qty text" title="Qty"
                                    value="{{ $cart['quantity'] }}" name="qty" min="1" step="1"
                                    data-id="{{ $key }}" data-variant-id="{{ $key }}">

                                <input type="button" class="plus" value="+" data-id="{{ $key }}"
                                    data-variant-id="{{ $key }}">

                            </form>
                        </div>
                    </td>
                    <td class="product-subtotal">
                        <span class="amount sub-total-{{ $key }}">
                            ${{ $total }}
                        </span>
                    </td>
                    <td class="product-remove">
                        <form action="{{ route('client.carts.delete', $key) }}" method="post"
                            id="form{{ $loop->iteration }}">
                            @csrf

                            <a title="Remove this item" class="remove submitLink"
                                data-form="form{{ $loop->iteration }}" href="#">
                                <i class="fa fa-times-circle"></i>
                            </a>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
