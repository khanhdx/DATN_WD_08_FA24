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
                {{-- <h3>Your selection ({{ Auth::check() ? count($cartItems->toArray()) : count($cartItems) }} items)</h3> --}}
                <div class="featured-box featured-box-cart">
                    <div class="box-content cart-view">

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
    </div>
@endsection

@section('js')
    <script>
        $(document).on('click', '.remove', function(e) {
            e.preventDefault();

            let href = $(this).attr('href');
            let data = {
                _token: '{{ csrf_token() }}',
                _method: "DELETE"
            };

            $.post(href, data, function(res) {
                load_cart();
            });
        })

        function updateCart(id, productVariantId, qty) {
            let data = {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                quantity: qty,
                product_variant_id: productVariantId,
            };

            $.post(`http://datn_wd_08_fa24.test/carts/${id}`, data, function(res) {
                load_cart();
            });
        }

        function load_cart() {
            $.get("{{ route('client.carts.cart') }}", function(res) {
                $('.cart-view').html(res);
            });
        }

        load_cart();
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('.remove').click(function(e) {
                e.preventDefault();

                let href = $(this).attr('href');
                let data = {
                    _token: '{{ csrf_token() }}',
                    _method: "DELETE"
                };

                $.post(href, data, function(res) {
                    load_cart();
                });
            })

            $('.plus').click(function() {
                let input = $(this).siblings('.qty');
                let quantity = parseInt(input.val()) + 1;
                input.val(quantity);

                console.log(quantity);

                if (window.location.pathname === '/cart') {
                    let id = $(this).data('id');
                    let productVariantId = $(this).data('variant-id');
                    updateCart(id, productVariantId, quantity)
                }
            });

            $('.minus').click(function() {
                let input = $(this).siblings('.qty');
                let quantity = parseInt(input.val());

                if (quantity > 1) {
                    input.val(quantity - 1);
                    quantity -= 1
                } else {
                    return
                }

                console.log(quantity);

                if (window.location.pathname === '/cart') {
                    let id = $(this).data('id');
                    let productVariantId = $(this).data('variant-id');
                    updateCart(id, productVariantId, quantity)
                }
            });

            $('.qty').on('input', function() {
                let value = parseInt($(this).val());

                if (isNaN(value) || value < 1) {
                    $(this).val(1);
                }

                if (window.location.pathname === '/cart') {
                    let id = $(this).data('id');
                    let productVariantId = $(this).data('variant-id');
                    let quantity = value;
                    updateCart(id, productVariantId, quantity)
                }
            });

            $('.qty').on('keydown', function(e) {
                if ($.inArray(e.key, ["Backspace", "ArrowLeft", "ArrowRight", "Delete"]) !== -1 ||
                    (e.key >= "0" && e.key <= "9")) {
                    return;
                }
                e.preventDefault();
            });

            function load_cart() {
                $.get("{{ route('client.carts.cart') }}", function(res) {
                    $('.cart-view').html(res);
                });
            }
            load_cart();
        });
    </script> --}}
@endsection
