@extends('client.layouts.master')

@section('content')
    <div class="container">
        <div class="text-center mt-5">
            <h1 class="text-success">Thanh toán thành công!</h1>
            <p>Cảm ơn bạn đã mua hàng. Đơn hàng của bạn đang được xử lý.</p>

            @if (isset($statusOrder))
                <h4>Chi tiết đơn hàng #{{ $statusOrder->id }}</h4>
                <p><strong>Tổng tiền:</strong> {{ number_format($statusOrder->total_price, 0, ',', '.') }} VND</p>
                <p><strong>Trạng thái đơn hàng:</strong> 
                    @switch($statusOrder->status)
                        @case(1)
                            Đang xử lý
                            @break
                        @case(2)
                            Đang giao hàng
                            @break
                        @case(3)
                            Hoàn thành
                            @break
                        @case(5)
                            Đã hủy
                            @break
                        @case(6)
                            Đang chờ hoàn tiền
                            @break
                        @case(7)
                            Đã hoàn tiền
                            @break
                        @default
                            Không xác định
                    @endswitch
                </p>
            @endif

            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Quay về trang chủ</a>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Xem lịch sử đơn hàng</a>
        </div>
    </div>
@endsection
