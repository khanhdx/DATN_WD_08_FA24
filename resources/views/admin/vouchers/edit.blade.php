@extends('admin.layouts.master')
@section('title')
    Quản lý mã giảm giá
@endsection
@section('css')
    {{-- CSS --}}
    <style>
        .giaTri {
            display: none;
        }
        .checkRadio {
            display: flex;
            gap: 40px;
        }
        .input-group {
            align-items: baseline;
        }
        .lableValue {
            width: 5%;
            text-align: center;

        }
        #Value {
            width: 90%;
        }
        #radioV {
            padding-bottom: 0px;
            height: 39px !important;
        }
        #Value:focus {
            outline: none !important;
        }
        .nav-pills .nav-link.active{
            color: #555 !important;
            background-color: #cccccc;
            border-radius: 0px !important;
        }
        .flex-column {
            border-right: 1px solid #eee;
            background-color: #fafafa !important; 
        }
        .link-a {
            color: #2271b1 !important;
        }
        .link-a:hover {
            color: #1d5e94;
        }
        .flex-content {
            padding: 10px !important;
        }
        .alycia {
            align-items: baseline;
            margin: 0px;
        }
    </style>
@endsection
@section('content')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Sửa mã giảm giá</h3>
                </div>
            </div>
            <div>
                <div class="card-body">
                    <form action="{{ route('admin.voucher.update',$voucher->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-9">
                                <div class="card">
                                    <div class="card-header" style="padding: 5px 10px !important;">
                                        <label class="m-0 p-0" for="name">Tên</label>
                                    </div>
                                    <div class="card-body" style="padding: 10px">
                                        <input type="text" class="form-control form-control" value="{{$voucher->name}}" name="name" id="voucher_code">
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" style="padding: 5px 10px !important;">
                                        <label class="m-0 p-0" for="voucher_code">Mã</label>
                                    </div>
                                    <div class="card-body" style="padding: 10px">
                                        <input type="text" class="form-control form-control" value="{{$voucher->voucher_code}}" name="voucher_code" id="voucher_code">
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" style="padding: 5px 10px !important;">
                                        <label class="m-0 p-0" for="description">Mô tả</label>
                                    </div>
                                    <div class="card-body" style="padding: 10px">
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{$voucher->description}}</textarea>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" style="padding: 5px 10px !important;">
                                        <label class="m-0 p-0" for="">Chi tiết</label>
                                    </div>
                                    <div class="tab-content row m-0" id="myTabContent">
                                        <ul class="col-3 nav nav-pills flex-column text-center p-0">
                                            <li class="nav-item">
                                            <a class="nav-link link-a active" data-bs-toggle="pill" href="#home">Tổng Quan</a>
                                            </li>
                                            <li class="nav-item">
                                            <a class="nav-link link-a" data-bs-toggle="pill" href="#menu1">Giá trị</a>
                                            </li>
                                            <li class="nav-item">
                                            <a class="nav-link link-a" data-bs-toggle="pill" href="#menu2">Điều kiện</a>
                                            </li>
                                        </ul>
                                        <div class="col-9 tab-content flex-content">
                                            <div class="tab-pane container active p-0" id="home">
                                                <div>
                                                    <div class="row p-0 alycia mb-3">
                                                        <label class="p-0 col-3" for="value">Loại giảm giá:</label>
                                                        <select class="form-control form-control-sm col" name="value" id="">
                                                            <option {{$voucher->value == "Phần trăm"?"selected":""}} value="Phần trăm">Giảm giá theo phần trăm</option>
                                                            <option {{$voucher->value == "Cố địng"?"selected":""}} value="Cố định">Giảm giá cố địng</option>
                                                        </select>
                                                    </div>
                                                    <div class="row p-0 alycia mb-3">
                                                        <label class="p-0 col-3" for="quanlity">Số lượng mã:</label>
                                                        <input type="number" class="form-control form-control-sm col" value="{{$voucher->quanlity}}" name="quanlity" id="quanlity"><!-- Kiểu giảm -->
                                                    </div>
                                                    <div class="row p-0 alycia mb-3">
                                                        <label class="p-0 col-3" for="date_start">Ngày bắt đầu:</label>
                                                        <input type="datetime-local" class="form-control form-control-sm col" value="{{$voucher->date_start}}" name="date_start" id="date_start"><!-- Kiểu giảm -->
                                                    </div>
                                                    <div class="row p-0 alycia mb-3">
                                                        <label class="p-0 col-3" for="date_end">Ngày kết thúc:</label>
                                                        <input type="datetime-local" class="form-control form-control-sm col" value="{{$voucher->date_end}}" name="date_end" id="date_end"><!-- Kiểu giảm -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane container fade p-0" id="menu1">
                                                <div>
                                                    <div class="row p-0 alycia mb-3">
                                                        <label class="p-0 col-3" for="decreased_value">Mức giảm:</label>
                                                        <input type="number" class="form-control form-control-sm col" value="{{$voucher->decreased_value}}" name="decreased_value" id="decreased_value">
                                                        <input class="form-control form-control-sm col-1 text-center" value="{{$voucher->value == 'Phần trăm'?'%':'VNĐ'}}" type="text" disabled>
                                                    </div>
                                                    <div class="row p-0 alycia mb-3">
                                                        <label class="p-0 col-3" for="max_value">Giảm tối đa:</label>
                                                        <input type="number" class="form-control form-control-sm col" value="{{$voucher->max_value}}" name="max_value" id="max_value">
                                                        <input class="form-control form-control-sm col-1 text-center" value="VNĐ" type="text" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane container fade" id="menu2">
                                                <div>
                                                    <div class="row p-0 alycia mb-3">
                                                        <p class="col">Phiếu giảm giá áp dụng cho đơn đơn hàng có giá trị tối thiểu tương đương</p>
                                                    </div>
                                                    <div class="row p-0 alycia mb-3">
                                                        <label class="p-0 col-3" for="quanlity">Đơn hàng tối thiểu:</label>
                                                        <input type="number" class="form-control form-control-sm col" value="{{$voucher->condition}}" name="condition" id="quanlity">
                                                        <input class="form-control form-control-sm col-1 text-center" value="VNĐ" type="text" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-header" style="padding: 9px 12px !important">
                                        <h5 class="m-0 p-0">Cập nhật</h5>
                                    </div>
                                    <div class="card-body" style="padding: 8px 20px 20px">
                                        <div class="mb-3" style="text-align: end;">
                                            <a href="{{ route('admin.voucher.create') }}" class="btn btn-outline-primary">Thêm mới</a>
                                        </div>
                                        <div class=""><p style="font-size: 14px">
                                            <span class="label">Trạng thái</span>: <span class="text-success"><strong>{{$voucher->status}}</strong></span>
                                            <input type="hidden" name="status" value="{{$voucher->status}}">
                                        </p></div>
                                        <div class=""><p style="font-size: 14px">
                                            <span class="label">Hiển thị</span>: <span class="text-success"><strong>{{$voucher->type_code}}</strong></span>
                                            <input type="hidden" name="type_code" value="{{$voucher->type_code}}">
                                        </p></div>
                                        <div class=""><p style="font-size: 14px">
                                            <span class="label">Ngày nhập</span>: <span class="text-dark">{{$voucher->created_at}}</span>
                                        </p></div>
                                        <div class=""><p style="font-size: 14px">
                                            <span class="label">Cập nhập gần nhất</span>: <span class="text-dark">{{$voucher->updated_at}}</span>
                                        </p></div>
                                    </div>
                                    <div class="card-footer">
                                        <div>
                                            <a href="#" style="font-size: 14px;color:#b02a37 !important;text-decoration:underline;">Xóa mã này</a>
                                        </div>
                                        <div>
                                            <a href="#" style="font-size: 14px;color:#b02a37 !important;text-decoration:underline;">Hủy thay đổi</a>
                                        </div>
                                        <div style="text-align: end;">
                                            <button class="btn btn-primary">Cập nhập</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    {{-- JAVA SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2e8884d211.js" crossorigin="anonymous"></script>
    <script>
        const coDinh = document.querySelector('#coDinh');
        const labelCoDinh = document.querySelector('#labelCoDinh');
        const phanTram = document.querySelector('#phanTram');
        const labelPhanTram = document.querySelector('#labelPhanTram');

        labelCoDinh.addEventListener('click', function () {
            coDinh.checked = true;
            labelPhanTram.style.color = "#495577";
            if (coDinh.checked) {
                labelCoDinh.style.color = "#FF8C00";
            }
        });
        labelPhanTram.addEventListener('click', function () {
            phanTram.checked = true;
            labelCoDinh.style.color = "#495577";
            if(phanTram.checked) {
                labelPhanTram.style.color = "#FF8C00";
            }
        });
    </script>
@endsection
