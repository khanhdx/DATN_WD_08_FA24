@extends('client.layouts.master')

@section('title', 'Danh sách đơn hàng')
@section('text_page')
đơn hàng của bạn
@endsection
@section('content')
@include('client.layouts.components.pagetop', ['md' => 'md'])
    <div class="container my-5">
        <div class="order-list">
            {{-- <h1 class="page-title text-center mb-4">Danh sách đơn hàng của bạn</h1> --}}

            <table class="table table-hover table-bordered">
                <thead class="table-dark text-center">
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
                        <tr class="align-middle text-center">
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->total_price }} VND</td>
                            <td>
                                @if ($order->statusOrder->isNotEmpty())
                                    <span >{{ $order->statusOrder->first()->name_status }}</span>
                                @else
                                    <span >Chưa có trạng thái</span>
                                @endif
                            </td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->note ?: 'Không có ghi chú' }}</td>
                            <td>
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('orders.show', $order->id) }}">Xem chi tiết</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
