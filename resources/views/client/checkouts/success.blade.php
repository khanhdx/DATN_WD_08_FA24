@extends('client.layouts.master') 

@section('content')
    <div class="container">
        <div class="text-center mt-5">
            <h1 class="text-success">Thanh toán thành công!</h1>
            <p>Cảm ơn bạn đã mua hàng. Đơn hàng của bạn đã được xử lý.</p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Quay về trang chủ</a>
            <a href="" class="btn btn-secondary mt-3">Xem lịch sử đơn hàng</a>
        </div>
    </div>
@endsection
