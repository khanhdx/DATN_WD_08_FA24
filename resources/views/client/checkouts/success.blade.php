@extends('client.layouts.master')

@section('text_page')
    Cảm ơn bạn đã đặt hàng!
@endsection

@section('content')
    @include('client.layouts.components.pagetop')
    <div class="container mb-6">
        <div class="text-center">
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

            <a href="{{ route('client.home') }}" class="btn btn-grey">Quay về trang chủ</a>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Xem lịch sử đơn hàng</a>
        </div>
    </div>
@endsection
