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
                <tr id="table-order">
                    <th>ID</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thanh toán</th>
                    <th>Hình thức</th>
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
                        <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                        <td class="order-id" data-order-id="{{ $order->id }}" id="status-{{ $order->id }}">
                            {{ $order->statusOrder->last()->status_label ?? 'Chưa có trạng thái' }}
                        </td>
                        <td>
                            @if ($order->payments->isNotEmpty())
                                @foreach ($order->payments as $payment)
                                    <!-- Kiểm tra trạng thái thanh toán -->
                                    @if ($payment->status == 1)
                                        Đã hoàn thành
                                    @elseif ($payment->status == 0)
                                        Chưa thanh toán
                                    @else
                                        Không xác định
                                    @endif
                                @endforeach
                            @else
                                <span>Chưa có trạng thái</span>
                            @endif
                        </td>
                        <td>
                            @if ($order->payments->isNotEmpty())
                                @foreach ($order->payments as $payment)
                                    {{ $payment->payment_method }} <!-- Hiển thị phương thức thanh toán -->
                                @endforeach
                            @else
                                <span>Chưa thanh toán</span>
                            @endif </td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->note ?: 'Không có ghi chú' }}</td>
                        <td>
                            <a class="btn btn-outline-primary btn-xs" href="{{ route('orders.show', $order->id) }}">
                                Xem chi tiết
                            </a>

                            @if ($order->statusOrder->contains('name_status', 'pending'))
                                <form id="cancel-button-{{ $order->id }}"
                                    action="{{ route('orders.update', $order->id) }}" method="POST"
                                    onsubmit="return confirm('Bạn có muốn hủy đơn hàng không')" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="name_status" value="canceled">
                                    <button type="submit" class="btn btn-grey btn-xs">
                                        Hủy đơn
                                    </button>
                                </form>
                            @elseif ($order->statusOrder->contains('name_status', 'success'))
                                <form action="{{ route('orders.update', $order->id) }}" method="POST"
                                    onsubmit="return confirm('Bạn xác nhận hoàn thành đơn hàng')" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="name_status" value="completed">
                                    <button type="submit" class="btn btn-outline-primary btn-xs">Hoàn thành</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderElements = document.querySelectorAll('.order-id');

            orderElements.forEach(function(orderElement) {
                const orderId = orderElement.dataset.orderId; // Lấy ID đơn hàng
                const cancelButton = document.querySelector(
                `#cancel-button-${orderId}`); // Nút hủy đơn hàng
                const successButton = document.querySelector(
                `#success-button-${orderId}`); // Nút Hoàn thành đơn hàng

                // Hàm thực hiện polling trạng thái đơn hàng
                const fetchOrderStatus = () => {
                    fetch(`/orders/${orderId}/status`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status) {
                                const currentStatus = data.status; // Trạng thái hiện tại từ server
                                const statusCell = document.querySelector(`#status-${orderId}`);

                                // Cập nhật trạng thái hiển thị nếu có thay đổi
                                if (statusCell.textContent.trim() !== currentStatus) {
                                    statusCell.textContent = currentStatus;

                                    // Ẩn nút hủy nếu trạng thái không còn là "pending"
                                    if (currentStatus !== 'pending' && cancelButton) {
                                        cancelButton.style.display = 'none';
                                    }
                                    else {
                                        // Nếu trạng thái là success
                                        if (currentStatus == 'success') {
                                            successButton.style.display = 'block';
                                        }
                                        else {
                                            successButton.style.display = 'none';
                                        }
                                    }
                                }
                                
                            }
                        })
                        .catch(error => console.error('Lỗi khi lấy trạng thái đơn hàng:', error));
                };
                // Thực hiện polling liên tục
                const pollStatus = () => {
                    fetchOrderStatus();

                    setTimeout(pollStatus, 1000); // Gọi lại sau 1 giây
                };

                pollStatus(); // Bắt đầu polling
            });
        });
    </script>
@endsection
