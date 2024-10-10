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

    </style>
@endsection
@section('content')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Thêm mới mã giảm giá</h3>
                </div>
            </div>
            <div>
                <div class="card-body">
                    <div class="w-75 m-auto">
                        <form action="{{ route('admin.voucher.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="">Tên phiếu giảm giá</label>
                                <input class="form-control" type="text" name="name" id="" placeholder="Nhập tên">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="">Mã phiếu giảm giá</label>
                                <input class="form-control" type="text" name="voucher_code" id="" placeholder="Nhập mã">
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label" for="">Mức giảm</label>
                                    <div id="radioV" class="input-group form-control">
                                        <input class="" id="Value" type="text" name="decreased_value" id="" placeholder="Nhập giá trị">
                                        <input class="giaTri" type="radio" checked name="value" id="coDinh" value="Cố định">
                                        <label id="labelCoDinh" class="lableValue" for="coDinh"><i class="fa-solid fa-dollar-sign"></i></label>
                                        <input class="giaTri" type="radio" name="value" id="phanTram" value="Phần trăm">
                                        <label id="labelPhanTram" class="lableValue" for="phanTram"><i class="fa-solid fa-percent"></i></label>
                                    </div>
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="">Giá trị tối đa</label>
                                    <input class="form-control" type="text" name="max_value" id="" placeholder="Nhập giá trị tối đa">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label" for="">Số lượng</label>
                                    <input class="form-control" type="text" name="quanlity" id="" placeholder="Nhập số lượng">
                                </div>
                                <div class="col form-group">
                                    <label class="form-label" for="">Điều kiện</label>
                                    <input class="form-control" type="text" name="condition" id="" placeholder="Nhập điều kiện">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="">Từ ngày</label>
                                <input class="form-control" type="date" name="date_start" id="">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="">Đến ngày</label>
                                <input class="form-control" type="date" name="date_end" id="">
                            </div>
                            <div class="checkRadio mb-3">
                                <p class="form-label mr-3">Kiểu</p>
                                <div>
                                    <input class="form-check-input" id="congkhai" value="Công khai" type="radio" name="type_code">
                                    <label class="form-check-label" for="congkhai">Công khai</label>
                                </div>
                                <div>
                                    <input class="form-check-input" id="canhan" value="Cá nhân" type="radio" name="type_code">
                                    <label class="form-check-label" for="canhan">Cá nhân</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="">Mô tả</label>
                                <textarea name="description" class="form-control" cols="10" rows="5"></textarea>
                            </div>
                            <div>
                                <a class="btn btn-danger" href="{{ route('admin.voucher.index') }}">Quay lại</a>
                                <button class="btn btn-primary" type="submit">Tạo mã</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    {{-- JAVA SCRIPT --}}
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
