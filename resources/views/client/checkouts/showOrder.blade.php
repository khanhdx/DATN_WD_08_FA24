@extends('client.layouts.master')

@section('title', 'Chi tiết đơn hàng')
@section('text_page')
    Chi tiết đơn hàng {{ $order->id }}
@endsection
@section('content')
    <div class="order-details">
        @include('client.layouts.components.pagetop', ['md' => 'md'])
        <div class="container">
            <div class="order-info">
                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }} VND</p>
                <p><strong>Trạng thái:</strong>
                    @foreach ($order->statusOrder as $status)
                        {{ $status->name_status }}
                    @endforeach
                </p>
                <p><strong>Địa chỉ giao hàng:</strong> {{ $order->address }}</p>

                @if ($order->voucherWare)
                    <p><strong>Voucher:</strong> {{ $order->voucherWare->voucher->voucher_code }}</p>
                    <p><strong>Giá giảm:</strong> {{ $order->voucherWare->voucher->decreased_value }}</p>
                @else
                    <p><strong>Voucher:</strong> Không có</p>
                @endif
            </div>

            <h2 class="section-title mt-4 mb-3">Sản phẩm trong đơn hàng</h2>
            <table class="table table-bordered table-hover">
                <thead class="table-secondary text-center">
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
                        <tr class="align-middle text-center">
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

            <h2 class="section-title mt-4 mb-3">Thông tin thanh toán</h2>
            {{-- 
        <p><strong>Phương thức thanh toán:</strong> {{ $order->payment->payment_method }}</p>
        <p><strong>Trạng thái thanh toán:</strong> {{ $order->payment->status == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}</p> 
        --}}

            <div class="text-center mt-4">
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">Quay lại danh sách đơn hàng</a>
            </div>
        </div>
    </div>
    </div>
@endsection
