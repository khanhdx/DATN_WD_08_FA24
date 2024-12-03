@extends('client.layouts.master')

@section('title', 'Chi tiết hóa đơn')
@section('text_page')
    Chi tiết hóa đơn #{{ $order->id }}
@endsection

@section('content')
    <div class="bill-details">
        @include('client.layouts.components.pagetop', ['md' => 'md'])
        <div class="container">
            <div class="order-info">
                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }} VND</p>
                <p><strong>Trạng thái đơn hàng:</strong>
                    @foreach ($order->statusOrder as $status)
                        {{ $status->name_status }}
                    @endforeach
                </p>
                <p><strong>Địa chỉ giao hàng:</strong> {{ $order->address }}</p>

                @if ($order->voucherWare)
                    <p><strong>Voucher:</strong> {{ $order->voucherWare->voucher->voucher_code }}</p>
                    <p><strong>Giảm giá:</strong> {{ number_format($order->voucherWare->voucher->decreased_value, 0, ',', '.') }} VND</p>
                @else
                    <p><strong>Voucher:</strong> Không có</p>
                @endif
            </div>

            <h2 class="section-title">Sản phẩm trong đơn hàng</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Kích thước</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_details as $orderDetail)
                        <tr>
                            <td>{{ $orderDetail->name_product }}</td>
                            <td>{{ $orderDetail->color }}</td>
                            <td>{{ $orderDetail->size }}</td>
                            <td>{{ $orderDetail->quantity }}</td>
                            <td>{{ number_format($orderDetail->unit_price, 0, ',', '.') }} VND</td>
                            <td>{{ number_format($orderDetail->total_price, 0, ',', '.') }} VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h2 class="section-title">Thông tin thanh toán</h2>
            <p><strong>Phương thức thanh toán:</strong>
                @if ($order->payments->isNotEmpty())
                    @foreach ($order->payments as $payment)
                        {{ $payment->payment_method }} <!-- Hiển thị phương thức thanh toán -->
                    @endforeach
                @else
                    <span>Chưa thanh toán</span>
                @endif
            </p>
            <p><strong>Trạng thái thanh toán:</strong>
                @if ($order->payments->isNotEmpty())
                    @foreach ($order->payments as $payment)
                        {{ $payment->status == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}
                    @endforeach
                @else
                    <span>Chưa có trạng thái thanh toán</span>
                @endif
            </p>

            <a href="{{ route('search.bill') }}" class="btn btn-secondary">Quay lại trang tìm kiếm</a>
        </div>
    </div>
@endsection
