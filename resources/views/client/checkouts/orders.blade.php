@extends('client.layouts.master')

@section('title', 'Danh sách đơn hàng')
@section('text_page')
    Danh sách đơn hàng
@endsection

@section('content')
@include('client.layouts.components.pagetop', ['md' => 'md'])

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
                                {{ $order->statusOrder->first()->name_status }}  {{-- Lấy trạng thái đầu tiên --}}
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
