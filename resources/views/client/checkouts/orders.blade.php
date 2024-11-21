@extends('client.layouts.master')

@section('title', 'Danh sách đơn hàng')
@section('text_page')
    Danh sách đơn hàng
@endsection

@section('content')
    @include('client.layouts.components.pagetop', ['md' => 'md'])
    <div class="container">
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
                        <td>{{ number_format($order->total_price, 0, ',', '.'
                        ) }} VND</td>
                        <td>
                            <strong>Trạng thái:</strong>
                            @if ($order->statusOrder->isNotEmpty())
                                {{-- Kiểm tra xem có trạng thái không --}}
                                @foreach ($order->statusOrder as $status)
                                    {{ $status->status_label }}
                                @endforeach
                            @else
                                <span>Chưa có trạng thái</span>
                            @endif
                        </td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->note ?: 'Không có ghi chú' }}</td>
                        <td>
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('orders.show', $order->id) }}">Xem chi
                                tiết</a>


                                @if ($order->statusOrder->contains('name_status', 'pending'))
                                <form action="{{ route('orders.update', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có muốn hủy đơn hàng không')" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="name_status" value="canceled">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Hủy đơn hàng</button>
                                </form>
                            @endif
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>

@endsection
