@extends('client.layouts.master')

@section('title', 'Chi tiết đơn hàng')
@section('text_page')
    Chi tiết đơn hàng {{ $order->id }}
@endsection
@section('content')
    <div class="order-details">
        @include('client.layouts.components.pagetop', ['md' => 'md'])
        <div class="order-info">
            <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }} VND</p>
            <p><strong>Trạng thái:</strong>
                @foreach ($order->statusOrder as $status)
                    {{ $status->name_status }}
                @endforeach
            </p>
            <p><strong>Địa chỉ giao hàng:</strong> {{ $order->address }}</p>

            @if ($order->voucherWare)
                <p><strong>Voucher:</strong> {{ $order->voucherWare->voucher->voucher_code }}</p>
                <p><strong>Giá giảm:</strong> {{ $order->voucherWare->voucher->decreased_value }}</p>
            @else
                <p><strong>Voucher:</strong> Không có</p>
            @endif
        </div>

        <h2 class="section-title">Sản phẩm trong đơn hàng</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Màu sắc</th>
                    <th>Kích thước</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng giá</th>
                    <th>đánh giá </th>
                </tr>
            </thead>
            <tbody>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @foreach ($order->order_details as $orderDetail)
                    <tr>
                        <td>{{ $orderDetail->name_product }}</td>
                        <td>{{ $orderDetail->color }}</td>
                        <td>{{ $orderDetail->size }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                        <td>{{ number_format($orderDetail->unit_price, 0, ',', '.') }} VND</td>
                        <td>{{ number_format($orderDetail->total_price, 0, ',', '.') }} VND</td>
                        <td>
                            @if (Auth::check())
                                @if ($order->statusOrder->first()->id === 4)
                                    @php
                                        $existingReview = \App\Models\Review::where('order_id', $order->id)
                                            ->where('product_id', $orderDetail->product_id)
                                            ->where('user_id', auth()->id())
                                            ->first();
                                    @endphp

                                    @if ($existingReview)
                                        <p class="text-success">Bạn đã đánh giá sản phẩm này.</p>
                                        <button class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#viewReviewModal-{{ $orderDetail->product_id }}">
                                            Xem đánh giá
                                        </button>
                                    @else
                                        <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#reviewModal-{{ $orderDetail->product_id }}">
                                            Đánh giá
                                        </button>
                                    @endif
                                @else
                                    <p class="text-danger">Bạn chỉ có thể đánh giá khi đơn hàng đã hoàn thành.</p>
                                @endif
                            @else
                                <p class="text-danger">Bạn cần đăng nhập để đánh giá sản phẩm.</p>
                            @endif
                        </td>
                    </tr>

                    <!-- Review Modal -->
                    {{-- <div class="modal fade" id="reviewModal-{{ $orderDetail->product_id }}" tabindex="-1"
                        aria-labelledby="reviewModalLabel-{{ $orderDetail->product_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="reviewForm-{{ $orderDetail->product_id }}"
                                action="{{ route('client.orders.product.review', ['orderId' => $order->id, 'productId' => $orderDetail->product_id]) }}"
                                method="POST" class="review-form">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reviewModalLabel-{{ $orderDetail->product_id }}">
                                            Đánh giá sản phẩm</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">{{ $orderDetail->name_product }}</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="rating" class="form-label">Xếp hạng</label>
                                            <select name="rating" id="rating" class="form-select" required>
                                                <option value="" disabled selected>Chọn xếp hạng</option>
                                                <option value="1">1 Sao</option>
                                                <option value="2">2 Sao</option>
                                                <option value="3">3 Sao</option>
                                                <option value="4">4 Sao</option>
                                                <option value="5">5 Sao</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="review" class="form-label">Nhận xét</label>
                                            <textarea name="review" id="review" class="form-control" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                    <div class="modal fade" id="reviewModal-{{ $orderDetail->product_id }}" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="reviewForm-{{ $orderDetail->product_id }}"
                                action="{{ route('client.orders.product.review', ['orderId' => $order->id, 'productId' => $orderDetail->product_id]) }}"
                                method="POST" class="review-form">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Đánh giá sản phẩm {{ $orderDetail->name_product }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="rating-{{ $orderDetail->product_id }}" class="form-label">Xếp
                                                hạng</label>
                                            <select name="rating" id="rating-{{ $orderDetail->product_id }}"
                                                class="form-select" required>
                                                <option value="" disabled selected>Chọn xếp hạng</option>
                                                <option value="1">1 Sao</option>
                                                <option value="2">2 Sao</option>
                                                <option value="3">3 Sao</option>
                                                <option value="4">4 Sao</option>
                                                <option value="5">5 Sao</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="review-{{ $orderDetail->product_id }}" class="form-label">Nhận
                                                xét</label>
                                            <textarea name="review" id="review-{{ $orderDetail->product_id }}" class="form-control" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <h2 class="section-title">Thông tin thanh toán</h2>
        {{-- <p><strong>Phương thức thanh toán:</strong> {{ $order->payment->payment_method }}</p>
    <p><strong>Trạng thái thanh toán:</strong> {{ $order->payment->status == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}</p> --}}

        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại danh sách đơn hàng</a>
    </div>

    <script>
        document.querySelectorAll('.review-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(this);
                const url = this.action;
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

                if (!csrfToken) {
                    console.error("CSRF token không tồn tại.");
                    alert("Lỗi bảo mật: CSRF token không tìm thấy.");
                    return;
                }

                fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            alert(data.message);

                            // Đóng modal sau khi gửi đánh giá thành công
                            const modalElement = this.closest('.modal');
                            const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
                            modal.hide();

                            // Kiểm tra nếu dữ liệu đánh giá tồn tại trước khi thêm vào giao diện
                            if (data.review && data.review.user) {
                                const reviewContainer = document.getElementById('reviews');
                                const newReview = document.createElement('div');
                                newReview.classList.add('review-item');
                                newReview.innerHTML = `
                            <strong>${data.review.user.name}</strong> - Đánh giá: ${data.review.rating}/5
                            <p>${data.review.review}</p>
                        `;
                                reviewContainer.prepend(newReview);
                            } else {
                                console.warn("Dữ liệu đánh giá không hợp lệ.");
                            }
                        } else {
                            alert(data.error || "Đã xảy ra lỗi.");
                        }
                    })
                    .catch(error => console.error("Lỗi gửi đánh giá:", error));
            });
        });
    </script>
    {{-- <script>
        document.querySelectorAll('.review-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Ngăn chặn hành vi mặc định
    
                const formData = new FormData(this);
                const url = this.action;
    
                fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message); // Hiển thị thông báo thành công
                        const modal = bootstrap.Modal.getInstance(this.closest('.modal'));
                        modal.hide(); // Đóng modal
                        location.reload(); // Tải lại trang để cập nhật đánh giá
                    } else {
                        alert(data.error || "Đã xảy ra lỗi.");
                    }
                })
                .catch(error => {
                    console.error("Lỗi gửi đánh giá:", error);
                });
            });
        });
    </script> --}}
@endsection

