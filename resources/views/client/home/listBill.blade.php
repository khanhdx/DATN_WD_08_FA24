@extends('client.layouts.master')

@section('text_page')
    Kết quả tìm kiếm hóa đơn
@endsection

@section('content')
@include('client.layouts.components.pagetop', ['md' => 'md'])

    <div class="container">
        <h2 class="text-center mt-4">Danh sách hóa đơn</h2>

        @if ($orders->isNotEmpty())
            <table class="table table-bordered mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Mã hóa đơn</th>
                        <th>Ngày đặt</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Tổng tiền</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->phone_number }}</td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                            <td>
                                <a href="{{ route('search.showBill', $order->id) }}" class="btn btn-info btn-sm">
                                    Xem
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning text-center mt-4">
                Không tìm thấy hóa đơn nào liên quan đến số điện thoại vừa tìm kiếm.
            </div>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('search.bill') }}" class="btn btn-primary">Quay lại tìm kiếm</a>
        </div>
    </div>
@endsection
