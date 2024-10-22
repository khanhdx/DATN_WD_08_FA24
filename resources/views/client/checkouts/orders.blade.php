@extends('client.layouts.master')

@section('title', 'Danh sách đơn hàng')

@section('content')
    <div class="order-list">
        <h1 class="page-title">Danh sách đơn hàng của bạn</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Địa chỉ</th>
                    <th>Ghi chú</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->date }}</td>
                        <td>{{ $order->total_price }}</td>

                        <td>
                            <strong>Trạng thái:</strong> 
                            @if ($order->statusOrder->isNotEmpty())  {{-- Kiểm tra xem có trạng thái không --}}
                               @foreach ($order->statusOrder as $status)
                                   {{ $status->status_label }}
                               @endforeach  
                            @else
                                <span>Chưa có trạng thái</span>
                            @endif                        
                        </td>

                        <td>{{ $order->address }}</td>
                        <td>{{ $order->note }}</td>
                        <td><a class="btn btn-primary" href="{{ route('orders.show', $order->id) }}">Xem chi tiết</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
