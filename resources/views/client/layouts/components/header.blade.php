@php
    use App\Models\Cart;
    use App\Models\CartItem;

    $total = 0;

    if (Auth::check()) {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $items = CartItem::with('productVariant')->where('cart_id', $cart->id);

        $carts = $items->latest('id')->get();

        $total = $items->sum('sub_total');
    } else {
        $carts = session()->get('cart', []);

        $total = array_sum(array_column($carts, 'sub_total'));
    }
@endphp

<div id="top">
    <div class="container">
        <p class="pull-left text-note">Free Shipping on all U.S orders over $50</p>
        <ul class="nav nav-pills nav-top navbar-right">
            <li class="dropdown langs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img
                        src="/assets/client/images/flags/en.gif" alt="English"> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#"><img src="/assets/client/images/flags/ar.gif" alt="AR"></a></li>
                    <li><a href="#"><img src="/assets/client/images/flags/ca.gif" alt="CA"></a></li>
                    <li><a href="#"><img src="/assets/client/images/flags/de.gif" alt="DE"></a></li>
                    <li><a href="#"><img src="/assets/client/images/flags/es.gif" alt="ES"></a></li>
                    <li><a href="#"><img src="/assets/client/images/flags/et.gif" alt="ET"></a></li>
                    <li><a href="#"><img src="/assets/client/images/flags/fa.gif" alt="FA"></a></li>
                    <li><a href="#"><img src="/assets/client/images/flags/fr.gif" alt="FR"></a></li>
                    <li><a href="#"><img src="/assets/client/images/flags/ja.gif" alt="JA"></a></li>
                </ul>
            </li>
            <li class="dropdown my-account">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <span
                        class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">My Dashboard</a></li>
                    <li><a href="#">Account Information</a></li>
                    <li><a href="#">Address Book</a></li>
                    <li><a href="#">My Orders</a></li>
                </ul>
            </li>
            <li class="dropdown menu-shop">
                <a href="{{ route('client.carts.index') }}" class="dropdown-toggle dropdownLink" data-toggle="dropdown">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="shopping-bag">{{ Auth::check() ? count($carts->toArray()) : count($carts) }}</span>
                </a>
                <div class="dropdown-menu">
                    <h3>Recently added item(s)</h3>
                    <ul class="list-unstyled list-thumbs-pro">
                        @foreach ($carts as $key => $cart)
                            <li class="product">
                                <div class="product-thumb-info">
                                    <form action="{{ route('client.carts.delete', Auth::check() ? $cart->id : $key) }}"
                                        method="post" id="form{{ $loop->iteration }}">
                                        @csrf
                                        @method('DELETE')

                                        <a title="Remove this item" class="product-remove submitLink"
                                            data-form="form{{ $loop->iteration }}" href="#">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </form>
                                    <div class="product-thumb-info-image">
                                        <a href="shop-product-detail1.html"><img alt="" width="60"
                                                src="{{ Auth::check() ? $cart->productVariant->product->image : $cart['image'] }}"></a>
                                    </div>

                                    <div class="product-thumb-info-content">
                                        <h4><a
                                                href="">{{ Auth::check() ? $cart->productVariant->product->name : $cart['name'] }}</a>
                                        </h4>
                                        <span class="item-cat"><small><a
                                                    href="#">x{{ Auth::check() ? $cart->quantity : $cart['quantity'] }}</a></small></span>
                                        <span
                                            class="price">{{ Auth::check() ? $cart->productVariant->price : $cart['price'] }}
                                            USD</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                    <ul class="list-inline cart-subtotals text-right">
                        <li class="cart-subtotal"><strong>Subtotal</strong></li>
                        <li class="price"><span
                                class="amount"><strong>${{ $total }}</strong></span>
                        </li>
                    </ul>
                    <div class="cart-buttons text-right">
                        <a href="{{ route('client.carts.index') }}"><button class="btn btn-white">View Cart</button></a>
                        <button class="btn btn-primary">Checkout</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
