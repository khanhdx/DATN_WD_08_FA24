@extends('client.layouts.master')

@section('title', 'Thanh Toán')
@section('text_page')
    Thanh Toán
@endsection

@section('content')
    <div role="main" class="main">
        <!-- Thông báo lỗi -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <h4>Đặt hàng thành công!</h4>
                <p>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng.</p>
            </div>
        @endif

        @include('client.layouts.components.pagetop', ['md' => 'md'])

        <div class="container">
            <div id="loader" style="display: none;">
                <div class="loading-text">Đang xử lý dữ liệu
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="row featured-boxes">
                <div class="col-md-8">
                    <form id="form-order"
                        action="{{ auth()->check() ? route('checkout.process') : route('guest.checkout.process') }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="ship_fee" id="input_ship_fee" value="0">
                        <div class="featured-box featured-box-secondary featured-box-cart">
                            <div class="box-content">
                                <h4>Thông tin Thanh Toán</h4>
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputLN" class="col-sm-2 control-label">Họ và tên <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputLN" name="user_name"
                                                required value="{{ auth()->check() ? auth()->user()->name : old('user_name') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Địa Chỉ Email <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" name="email"
                                                required
                                                value="{{ auth()->check() ? auth()->user()->email : old('email') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPhone" class="col-sm-2 control-label">Số Điện Thoại
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control" id="inputPhone" name="phone_number"
                                                required value="{{ auth()->user() ? auth()->user()->phone_number : old('phone_number') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputNote" class="col-sm-2 control-label">Ghi chú</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputNote" name="note" rows="3" placeholder="Nhập ghi chú nếu có">{{ old('note') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="province" class="control-label">
                                            Tỉnh / Thành phố <span class="required">*</span>
                                        </label>
                                        <select name="province" id="province" class="form-control" required>
                                            <option value="">Chọn Tỉnh / Thành phố</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="district" class="control-label">Quận / Huyện <span
                                                class="required">*</span></label>
                                        <select name="district" id="district" class="form-control" required>
                                            <option value="">Chọn Quận / Huyện</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ward_street" class="control-label">Phường / Xã <span
                                                class="required">*</span></label>
                                        <select name="ward_street" id="ward_street" class="form-control" required>
                                            <option value="">Chọn Phường / Xã</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Số nhà, tên đường cụ thể</label>
                                        <input type="text" name="address" id="address" class="form-control" required
                                            value="{{ auth()->user() ? auth()->user()->address : old('address') }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <h4>Phương Thức Thanh Toán</h4>
                        <div class="panel-group panel-group2" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <label>
                                            <input type="radio" name="payment_method" value="COD" required>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseCOD">
                                                Thanh Toán Khi Nhận Hàng (COD)
                                            </a>
                                        </label>
                                    </h5>
                                </div>
                                <div id="collapseCOD" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Thanh toán bằng tiền mặt khi nhận hàng. Vui lòng chuẩn bị số tiền chính xác.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <label>
                                            <input type="radio" name="payment_method" value="MOMO" required>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseMomo">Thanh
                                                Toán Qua Momo</a>
                                        </label>
                                    </h5>
                                </div>
                                <div id="collapseMomo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Thanh toán qua Momo. Bạn sẽ được chuyển hướng tới trang Momo để thực hiện giao
                                            dịch.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>
                            <button type="submit" class="btn btn-primary btn-block btn-sm">Đặt Hàng</button>
                        </p>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="featured-box featured-box-secondary sidebar">
                        <div class="box-content">
                            <h4>Đơn Hàng Của Bạn</h4>
                            <table cellspacing="0" class="cart-totals" width="100%">
                                <tbody>
                                    @php
                                        $totalPrice = 0;
                                        $quantityCart = 0;
                                        $discount = session('discount', 0); // Lấy giá trị giảm giá từ session
                                    @endphp
                                    @foreach ($cartItems as $item)
                                        <tr class="cart_item">
                                            <th>
                                                @if (is_object($item) && $item->productVariant && $item->productVariant->product)
                                                    {{ $item->productVariant->product->name }} ({{ $item->quantity }})
                                                @elseif (is_array($item) && isset($item['productVariant']) && isset($item['productVariant']['product']))
                                                    {{ $item['productVariant']['product']['name'] }}
                                                    ({{ $item['quantity'] }})
                                                @else
                                                    {{ $item['name'] }}
                                                    ({{ isset($item['quantity']) ? $item['quantity'] : '0' }})
                                                @endif
                                            </th>
                                            <td class="product-price">
                                                <span
                                                    class="amount">{{ isset($item['sub_total']) ? number_format($item['sub_total'], 0, ',', '.') : '0' }} ₫</span>
                                            </td>
                                        </tr>
                                        @php
                                            $totalPrice += isset($item['sub_total']) ? $item['sub_total'] : 0;
                                            $quantityCart += isset($item['quantity']) ? $item['quantity'] : 0;
                                            // $quantityCart += $item->quantity;
                                        @endphp
                                    @endforeach


                                    <tr class="cart_subtotal">
                                        <th>Tổng Giỏ Hàng</th>
                                        <td class="product-price">
                                            <span class="amount"
                                                id="subtotalAmount">{{ number_format($totalPrice, 0, ',', '.') }} ₫</span>
                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Phí Vận Chuyển</th>
                                        <td class="product-price" id="shipping_fee">
                                            Miễn Phí Vận Chuyển
                                        </td>
                                    </tr>
                                    <tr class="discount">
                                        <th>Giảm Giá</th>
                                        <td class="product-price">
                                            <span class="amount"
                                                id="discountAmount">{{ number_format($discount, 0, ',', '.') }} ₫</span>
                                        </td>
                                    </tr>
                                    <tr class="total">
                                        <th>Tổng Cộng</th>
                                        <td class="product-price">
                                            <strong>
                                                <span class="amount" id="totalAmount"
                                                    data-total="{{ $totalPrice - $discount }}">
                                                    {{ number_format($totalPrice - $discount, 0, ',', '.') }} ₫
                                                </span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Form nhập mã giảm giá -->
                    <div class="featured-box featured-box-secondary">
                        <div class="box-content">
                            <h4>Nhập Mã Giảm Giá</h4>
                            <form action="{{ route('processVoucher') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="voucher_code" id="voucher_code"
                                        placeholder="Nhập mã giảm giá">
                                </div>
                                <p>
                                    <button type="submit" name="action" value="apply" class="btn btn-primary">
                                        Áp Dụng
                                    </button>
                                    <button type="submit" name="action" value="cancel" class="btn btn-danger">
                                        Hủy Voucher
                                    </button>
                                </p>
                            </form>
                            <!-- Thông báo mã giảm giá -->
                            @if (session('voucher_error'))
                                <div class="alert alert-danger">
                                    {{ session('voucher_error') }}
                                </div>
                            @endif
                            @if (session('voucher_success'))
                                <div class="alert alert-success">
                                    {{ session('voucher_success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        let quantity = {{ $quantityCart }};

        document.getElementById("form-order").addEventListener("submit", function(event) {
            document.getElementById("loader").style.display = "flex";
            document.querySelector("button[type='submit']").disabled = true;
        });
    </script>
    @vite('resources/js/shipping.js')
@endsection
