@extends('admin.layouts.master')
@section('css')
@endsection

@section('content')
    <div class="container">
        

        <div class="row">
            <div class="col-xxl-4">
                <div class="card mt-n5">
                    <div class="card-body p-20">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto mb-3">
                        <img src="{{ asset('assets/admin/images/icon/avatar-01.jpg') }}"
                            class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                    </div>
                    <h4 class="fs-16">{{ $order->user->name }}</h4>
                        </div>
                    </div>
                </div>
                <!--end card-->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0">Thông tin khách hàng</h5>
                            </div>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                    <i class="ri-github-fill"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" id="email" value="{{ $order->user->email }}" readonly>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-primary">
                                    <i class="ri-global-fill"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="phone_number" value="{{ $order->user->phone_number }}" readonly>
                        </div>
                        <div class="d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-danger">
                                    <i class="ri-pinterest-fill"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="role" value="{{ $order->user->role }}" readonly>
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-xxl-10">
                <div class="card mt-xxl-n1">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    
                                    <h3>Thông tin đơn hàng: order-1</h3>
                                    {{-- <h3>Thông tin giao hàng</h3> --}}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <form action="javascript:void(1);">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="customer_name" class="form-label">Tên người nhận</label>
                                                <input type="text" class="form-control" id="user_name" value="{{ $order->user->name }}" readonly>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="created_at" class="form-label">Ngày đặt hàng</label>
                                                <input type="text" class="form-control" id="date" value="{{ $order->date }}" readonly>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="number_phone" class="form-label">Số điện thoại</label>
                                                <input type="text" class="form-control" id="phone_number" value="{{ $order->user->phone_number }}" readonly>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email </label>
                                                <input type="email" class="form-control" id="email" value="{{ $order->user->email }}" readonly>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="payment_id" class="form-label">Phương thức thanh toán</label>
                                                <input type="text" class="form-control" id="payment_id" value="{{ $order->payments->first()->payment_method }}" readonly>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="status_id" class="form-label">Trạng thái đơn hàng </label>
                                                <input type="text" class="form-control" id="status_id" value="{{ $order->statuses->first()->name_status }}" readonly>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Địa chỉ giao hàng </label>
                                                <input type="text" class="form-control" id="address" value="{{ $order->address }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="card mt-n5">
                    <div class="card-body p-4">
                        <div class="table-responsive table-card p-4">
                            <table class="table table-nowrap table-striped-columns mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Đơn giá</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderDetails as $index => $orderDetail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $orderDetail->name_product }}</td>
                                            <td>{{ $orderDetail->quantity }}</td>
                                            <td>{{ number_format($orderDetail->unit_price) }}đ</td>
                                            <td>{{ number_format($orderDetail->total_price) }}đ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <h3 class="fw-bold">Tổng cộng:</h3>
                            <h4>{{ number_format($orderDetail->total_price) }}đ</h4>
                        </div>
                    </div>
                </div>

                <div class="card mt-n5 ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h2 class="fw-bold">Tổng thanh toán:</h2>
                            <h3>{{ number_format($orderDetail->total_price) }}đ</h3>
                    </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="card mt-n5">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary">Xuất hóa đơn</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    </div>
@endsection
