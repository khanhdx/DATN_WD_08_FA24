@extends('client.layouts.master')

@section('content')
    <div class="container">
        <div class="text-center mt-5">
            <h1 class="text-success">Thanh toán thành công!</h1>
            <p>Cảm ơn bạn đã mua hàng. Đơn hàng của bạn đã được xử lý.</p>

            @if (isset($statusOrder))
                <h4>Chi tiết đơn hàng #{{ $statusOrder->id }}</h4>
                <p>Tổng tiền: {{ number_format($statusOrder->total_price, 0, ',', '.') }} VND</p>
            @endif

            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Quay về trang chủ</a>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Xem lịch sử đơn hàng</a>
        </div>
    </div>
@endsection
