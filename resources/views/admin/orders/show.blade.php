@extends('admin.layouts.master')
@section('title')
    Quản lý đơn hàng
@endsection
@section('css')
@endsection
@section('content')
    <div class="container mt-5">
        <div>
            {{-- <div class="col-md-4">
                <div class="card text-center">
                    <img src="{{ $order->user->user_image ? Storage::url($order->user->user_image) : asset('assets/admin/images/icon/avatar-01.jpg') }}" class="rounded-circle mx-auto d-block mt-3" alt="Profile Image" style="width: 100px; height: 100px;">

                    <div class="card-body">
                        <h5 class="card-title">{{ $order->user->name }}</h5>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        Thông tin khách hàng
                    </div>
                    <div class="card-body">
                        <p>Email: {{ $order->user->email }}</p>
                        <p>Số điện thoại: {{ $order->user->phone_number }}</p>
                    
                    </div>
                </div>
            </div> --}}
            <div>
                <div class="card">
                    <div class="card-header">
                        Thông tin đơn hàng: DHBVQH144309
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="receiverName" class="form-label">Tên người nhận</label>
                                <input type="text" class="form-control" id="user_name" value="{{ $order->user->name }}"
                                    disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="orderDate" class="form-label">Ngày đặt hàng</label>
                                <input type="text" class="form-control" id="date" value="{{ $order->date }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone_number"
                                    value="{{ $order->user->phone_number }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ $order->user->email }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="paymentMethod" class="form-label">Phương thức thanh toán</label>
                                <input type="text" class="form-control" id="paymentMethod"
                                    value="{{ $order->payments->first()->payment_method }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="orderStatus" class="form-label">Trạng thái đơn hàng</label>
                                <input type="text" class="form-control" id="orderStatus"
                                    value="{{ $currentStatus->status_label }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="shippingAddress" class="form-label">Địa chỉ giao hàng</label>
                            <input type="text" class="form-control" id="address" value="{{ $order->address }}"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Ghi chú</label>
                            <input type="text" class="form-control" id="note" value="{{ $order->note }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Chi tiết sản phẩm
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Màu sắc</th>
                            <th scope="col">Kích thước</th>
                            <th scope="col">Giá sản phẩm</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_details as $index => $order_detail)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order_detail->name_product }}</td>
                                <td>{{ $order_detail->quantity }}</td>
                                <td>{{ $order_detail->color ?? 'Không có màu sắc' }}</td>
                                <td>{{ $order_detail->size ?? 'Khồn có size' }}</td>
                                <td>{{ number_format($order_detail->unit_price, 0, ',', '.') }} VND</td>
                                <td>{{ number_format($order_detail->total_price, 0, ',', '.') }} VND</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
