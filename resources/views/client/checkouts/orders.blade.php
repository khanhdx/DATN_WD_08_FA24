@extends('client.layouts.master')

@section('title', 'Danh sách đơn hàng')
@section('text_page')
    Danh sách đơn hàng
@endsection

@section('css')
    <style>
        .custom-return-btn {
            display: inline-block;
            font-size: 12px;
            padding: 5px 10px;
            color: #fff;
            background-color: #86d2c4;
            border: 1px solid #86d2c4;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .custom-return-btn:hover {
            background-color: #5e9087;
            border-color: #5e9087;
            color: #fff;
            transform: scale(1.05);
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
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
                    <th>Chi tiết đơn</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="align-middle text-center">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->date }}</td>
                        <td>{{ number_format($order->shipping_fee + $order->total_price, 0, ',', '.') }} VND</td>
                        <td class="order-id" data-order-id="{{ $order->id }}" id="status-{{ $order->id }}">
                            {{ $order->statusOrder->last()->status_label ?? 'Chưa có trạng thái' }}
                        </td>
                        <td>
                            @if ($order->payments->isNotEmpty())
                                @foreach ($order->payments as $payment)
                                    <!-- Kiểm tra trạng thái thanh toán -->
                                    @if ($payment->status == 1)
                                        Đã thanh toán
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
                            @endif
                        </td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->note ?: 'Không có ghi chú' }}</td>
                        <td>
                            <a class="btn btn-outline-primary btn-xs" href="{{ route('orders.show', $order->id) }}">
                                Xem chi tiết
                            </a>
                        </td>
                        <td>
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
                            @elseif ($order->statusOrder->contains('name_status', 'processing'))
                                <button type="button" class="btn btn-grey btn-xs"
                                    onclick="showCancelPopup({{ $order->id }})">
                                    Hủy đơn
                                </button>
                                <form id="cancel-form-{{ $order->id }}"
                                    action="{{ route('orders.update', $order->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="name_status" value="canceling">
                                    <input type="hidden" name="reason" value="">
                                </form>
                            @elseif ($order->statusOrder->contains('name_status', 'success'))
                                <form action="{{ route('orders.update', $order->id) }}" method="POST"
                                    onsubmit="return confirm('Bạn xác nhận hoàn thành đơn hàng')" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="name_status" value="completed">
                                    <button type="submit" class="btn btn-primary btn-xs" style="margin-bottom: 6px;">Hoàn
                                        thành</button>
                                </form>
                                <button type="button" class="btn btn-xs custom-return-btn"
                                    onclick="showReturnPopup({{ $order->id }})" style="display:inline;"">
                                    Hoàn hàng
                                </button>
                                <form id="return-form-{{ $order->id }}"
                                    action="{{ route('orders.update', $order->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="name_status" value="refunding">
                                    <input type="hidden" name="reason" value="">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                    if (currentStatus !== 'pending' && currentStatus !==
                                        'processing' && cancelButton) {
                                        cancelButton.style.display = 'none';
                                    } else {
                                        if (currentStatus == 'success') {
                                            successButton.style.display = 'block';
                                        } else {
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

        function showCancelPopup(orderId) {
            Swal.fire({
                title: '<h3 style="color:#444; font-size: 35px;">Lý do hủy đơn</h3>',
                html: `
            <div style="text-align: left; font-size: 16px;">
                <label style="display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;">
                    <input type="radio" name="cancel_reason" value="Không cần nữa" style="margin-right: 10px;"> 
                    <span style="margin-left: 5px;">Không cần nữa</span>
                </label>
                <label style="display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;">
                    <input type="radio" name="cancel_reason" value="Tìm được giá tốt hơn" style="margin-right: 10px;"> 
                    <span style="margin-left: 5px;">Tìm được giá tốt hơn</span>
                </label>
                <label style="display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;">
                    <input type="radio" name="cancel_reason" value="Đổi ý" style="margin-right: 10px;"> 
                    <span style="margin-left: 5px;">Đổi ý</span>
                </label>
                <label style="display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;">
                    <input type="radio" name="cancel_reason" value="Khác" style="margin-right: 10px;" 
                        onclick="document.getElementById('other-reason').style.display = 'block';"> 
                    <span style="margin-left: 5px;">Khác</span>
                </label>
                <input 
                    type="text" 
                    id="other-reason" 
                    placeholder="Nhập lý do khác..." 
                    style="display: none; width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px; margin-top: 10px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);"
                    onfocus="this.style.borderColor='#007bff';"
                    onblur="this.style.borderColor='#ccc';"
                >
            </div>
        `,
                showCancelButton: true,
                confirmButtonText: '<span style="font-weight: bold; color: white; font-size: 15px">Xác nhận</span>',
                cancelButtonText: '<span style="font-weight: bold; color: white; font-size: 15px;">Hủy</span>',
                width: '500px',
                background: '#f9f9f9',
                customClass: {
                    popup: 'custom-popup',
                    title: 'custom-title',
                    confirmButton: 'custom-confirm-btn',
                    cancelButton: 'custom-cancel-btn',
                },
                preConfirm: () => {
                    const selectedReason = document.querySelector('input[name="cancel_reason"]:checked');
                    if (!selectedReason) {
                        Swal.showValidationMessage('Vui lòng chọn một lý do!');
                        return null;
                    }
                    if (selectedReason.value === 'Khác') {
                        const otherReason = document.getElementById('other-reason').value.trim();
                        if (!otherReason) {
                            Swal.showValidationMessage('Vui lòng nhập lý do khác!');
                            return null;
                        }
                        return otherReason;
                    }
                    return selectedReason.value;
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    const reason = result.value;
                    console.log(reason);

                    document.querySelector(`#cancel-form-${orderId} input[name="reason"]`).value = reason;
                    document.querySelector(`#cancel-form-${orderId}`).submit();
                }
            });
        }


        function showReturnPopup(orderId) {
            Swal.fire({
                title: '<h3 style="color:#444; font-size: 35px;">Lý do hoàn hàng</h3>',
                html: `
            <div style="text-align: left; font-size: 16px;">
                <label style="display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;">
                    <input type="radio" name="return_reason" value="Sản phẩm bị lỗi hoặc hư hỏng" style="margin-right: 10px;" onclick="hideOtherReason()"> 
                    <span style="margin-left: 5px;">Sản phẩm bị lỗi hoặc hư hỏng</span>
                </label>
                <label style="display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;">
                    <input type="radio" name="return_reason" value="Giao sai sản phẩm" style="margin-right: 10px;" onclick="hideOtherReason()"> 
                    <span style="margin-left: 5px;">Giao sai sản phẩm</span>
                </label>
                <label style="display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;">
                    <input type="radio" name="return_reason" value="Sản phẩm không như mong đợi" style="margin-right: 10px;" onclick="hideOtherReason()"> 
                    <span style="margin-left: 5px;">Sản phẩm không như mong đợi</span>
                </label>
                <label style="display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;">
                    <input type="radio" name="return_reason" value="Hết nhu cầu sử dụng" style="margin-right: 10px;" onclick="hideOtherReason()"> 
                    <span style="margin-left: 5px;">Hết nhu cầu sử dụng</span>
                </label>
                <label style="display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;">
                    <input type="radio" name="return_reason" value="Khác" style="margin-right: 10px;" onclick="showOtherReason()"> 
                    <span style="margin-left: 5px;">Khác</span>
                </label>
                <input 
                    type="text" 
                    id="other-reason" 
                    placeholder="Nhập lý do khác..." 
                    style="display: none; width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px; margin-top: 10px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);"
                    onfocus="this.style.borderColor='#007bff';"
                    onblur="this.style.borderColor='#ccc';"
                >
            </div>
        `,
                showCancelButton: true,
                confirmButtonText: '<span style="font-weight: bold; color: white; font-size: 15px">Xác nhận</span>',
                cancelButtonText: '<span style="font-weight: bold; color: white; font-size: 15px;">Hủy</span>',
                width: '500px',
                background: '#f9f9f9',
                customClass: {
                    popup: 'custom-popup',
                    title: 'custom-title',
                    confirmButton: 'custom-confirm-btn',
                    cancelButton: 'custom-return-btn',
                },
                preConfirm: () => {
                    const selectedReason = document.querySelector('input[name="return_reason"]:checked');
                    if (!selectedReason) {
                        Swal.showValidationMessage('Vui lòng chọn một lý do!');
                        return null;
                    }
                    if (selectedReason.value === 'Khác') {
                        const otherReason = document.getElementById('other-reason').value.trim();
                        if (!otherReason) {
                            Swal.showValidationMessage('Vui lòng nhập lý do khác!');
                            return null;
                        }
                        return otherReason;
                    }
                    return selectedReason.value;
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    const reason = result.value;
                    Swal.fire({
                        title: '<h3 style="color: #d33; font-size: 25px; font-weight: bold;">Xác nhận hoàn hàng?</h3>',
                        html: `<p style="color: #555; font-size: 16px;">Bạn có chắc chắn muốn hoàn hàng với lý do: <b>"${reason}"</b>?</p>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: '<span style="font-size: 15px; font-weight: bold; color: white;">Đồng ý</span>',
                        cancelButtonText: '<span style="font-size: 15px; font-weight: bold; color: white;">Hủy</span>',
                        customClass: {
                            popup: 'custom-popup',
                            title: 'custom-title',
                            confirmButton: 'custom-confirm-btn',
                            cancelButton: 'custom-cancel-btn',
                        },
                    }).then((confirmation) => {
                        if (confirmation.isConfirmed) {
                            const form = document.querySelector(`#return-form-${orderId}`);
                            if (form) {
                                form.querySelector('input[name="reason"]').value = reason;
                                form.submit();
                            }
                        }
                    });
                }
            });
        }
        
        function showOtherReason() {
            document.getElementById('other-reason').style.display = 'block';
        }

        function hideOtherReason() {
            document.getElementById('other-reason').style.display = 'none';
        }
    </script>
@endsection
