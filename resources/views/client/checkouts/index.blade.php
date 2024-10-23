@extends('client.layouts.master')

@section('title', 'Thanh Toán')

@section('content')
    <div role="main" class="main">

        <!-- Begin page top -->
        <section class="page-top">
            <div class="container">
                <div class="page-top-in">
                    <h2><span>Thanh Toán</span></h2>
                </div>
            </div>
        </section>
        <!-- End page top -->

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
                                        <label for="inputFN" class="col-sm-2 control-label">Họ <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputFN" name="first_name"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputLN" class="col-sm-2 control-label">Tên <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputLN" name="last_name"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAdd" class="col-sm-2 control-label">Địa Chỉ <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputAdd" name="address"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCity" class="col-sm-2 control-label">Thành Phố <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputCity" name="city"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Địa Chỉ Email <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" name="email"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-sm-2 control-label">Số Điện Thoại <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control" id="inputPhone" name="phone"
                                                required>
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

                        <!-- Trường ẩn để lưu tổng giá đã giảm -->
                        <input type="hidden" name="total_after_discount" id="totalAfterDiscount">
                    </form>
                </div>

                <div class="col-md-4">
                    <div class="featured-box featured-box-secondary sidebar">
                        <div class="box-content">
                            <h4>Đơn Hàng Của Bạn</h4>
                            <table cellspacing="0" class="cart-totals" width="100%">
                                <tbody>
                                    @php $totalPrice = 0; @endphp
                                    @foreach ($cartItems as $item)
                                        <tr class="cart_item">
                                            <th>
                                                @if ($item->product)
                                                    {{ $item->product->name }} ({{ $item->quantity }})
                                                @else
                                                    Sản phẩm không tìm thấy ({{ $item->quantity }})
                                                @endif
                                            </th>
                                            <td class="product-price">
                                                <span class="amount">{{ number_format($item->totalPrice(), 0, ',', '.') }}
                                                    ₫</span>
                                            </td>
                                        </tr>
                                        @php $totalPrice += $item->totalPrice(); @endphp
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
                                        <td>Miễn Phí Vận Chuyển</td>
                                    </tr>
                                    <tr class="total">
                                        <th>Tổng Cộng</th>
                                        <td class="product-price">
                                            <strong><span class="amount"
                                                    id="totalAmount">{{ number_format($totalPrice, 0, ',', '.') }}
                                                    ₫</span></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        
    </script>
@endsection
