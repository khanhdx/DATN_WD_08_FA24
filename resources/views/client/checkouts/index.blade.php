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
            </div>
        @endif

        @include('client.layouts.components.pagetop', ['md' => 'md'])

        <div class="container">
            <div class="row featured-boxes">
                <div class="col-md-8">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="featured-box featured-box-secondary featured-box-cart">
                            <div class="box-content">
                                <h4>Địa Chỉ Thanh Toán</h4>
                                <div class="form-horizontal">
                                    <!-- Thông tin địa chỉ -->
                                    <div class="form-group">
                                        <label for="inputLN" class="col-sm-2 control-label">Họ và tên <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputLN" name="last_name"
                                                required value="{{ auth()->user() ? auth()->user()->name : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAdd" class="col-sm-2 control-label">Địa Chỉ <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputAdd" name="address"
                                                required value="{{ auth()->user() ? auth()->user()->address : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Địa Chỉ Email <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" name="email"
                                                required value="{{ auth()->user() ? auth()->user()->email : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-sm-2 control-label">Số Điện Thoại <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control" id="inputPhone" name="phone"
                                                required value="{{ auth()->user() ? auth()->user()->phone_number : '' }}">
                                        </div>
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
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseCOD">Thanh
                                                Toán Khi Nhận Hàng (COD)</a>
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
                                            <input type="radio" name="payment_method" value="VNPay" required>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseVNPay">Thanh
                                                Toán Qua VNPay</a>
                                        </label>
                                    </h5>
                                </div>
                                <div id="collapseVNPay" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Thanh toán qua VNPay. Bạn sẽ được chuyển hướng tới trang VNPay để thực hiện giao
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
                                        $discount = session('discount', 0); // Lấy giá trị giảm giá từ session
                                    @endphp
                                    @foreach ($cartItems as $item)
                                        <tr class="cart_item">
                                            <th>
                                                @if ($item->productVariant && $item->productVariant->product)
                                                    {{ $item->productVariant->product->name }} ({{ $item->quantity }})
                                                @else
                                                    Sản phẩm không tìm thấy ({{ $item->quantity }})
                                                @endif
                                            </th>
                                            <td class="product-price">
                                                <span class="amount">{{ $item->sub_total }}</span>
                                            </td>
                                        </tr>
                                        @php $totalPrice += $item->sub_total; @endphp
                                    @endforeach
                
                                    <tr class="cart_subtotal">
                                        <th>Tổng Giỏ Hàng</th>
                                        <td class="product-price">
                                            <span class="amount" id="subtotalAmount">{{ $totalPrice }} ₫</span>
                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Phí Vận Chuyển</th>
                                        <td>Miễn Phí Vận Chuyển</td>
                                    </tr>
                                    <tr class="discount">
                                        <th>Giảm Giá</th>
                                        <td class="product-price">
                                            <span class="amount" id="discountAmount">{{ $discount }} ₫</span>
                                        </td>
                                    </tr>
                                    <tr class="total">
                                        <th>Tổng Cộng</th>
                                        <td class="product-price">
                                            <strong><span class="amount" id="totalAmount">{{ $totalPrice - $discount }} ₫</span></strong>
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
                                    <input type="text" class="form-control" name="voucher_code" id="voucher_code" placeholder="Nhập mã giảm giá">
                                </div>
                                <p>
                                    <button type="submit" name="action" value="apply" class="btn btn-primary">Áp Dụng</button>
                                    <button type="submit" name="action" value="cancel" class="btn btn-danger">Hủy Voucher</button>
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
    <script></script>
@endsection
