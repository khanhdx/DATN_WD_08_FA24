@extends('admin.layouts.master')
@section('title')
    Mã giảm giá
@endsection
@section('css')
    <style>
        .titl-vv {
            font-size: 20px;
            font-weight: 400;
        }
        .nav-tabs-classic>li.nav-item a.nav-link.active{
            background: rgb(242, 242, 242);
        }
        .title-data {
            font-size: 14px;
            padding: 8px 12px;
            margin: 0;
            line-height: 1.4;
        }
        .user-item {
            padding: 8px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .user-image {
            border-radius: 50%;
        }
        .img-item {
            border-radius: 50%;
            border: 1px solid silver;
        }
        .ii-m {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-between;
        }
        .user-name {
            font-size: 16px;
            font-weight: 400;
            margin: 0px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .user-email {
            font-size: 10px;
        }
        .CoUs {
            font-size: 10px;
            background-color: #eafaf1;
            border: 1px solid #1e8449;
            color: #1e8449;
            border-radius: 10px;
            padding: 1px 5px;
        }
    </style>
    <style>
        .checkbox {
            width: 15px;
            height: 15px;
        }
        .modal-backdrop {
            z-index: -1;
        }
    </style>
@endsection
@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="card-header" style="border-bottom: 1px solid silver;">
                        <div class="titl-vv">Thêm mới mã giảm giá.</div>
                    </div>
                    <div class="card-body mt-3">
                        <form id="voucherForm" action="{{ route('admin.voucher.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-10">
                                    <div>
                                        <div class="input-form mb-3">
                                            <input class="form-control form-control-sm @error('name') is-invalid @enderror" type="text" value="{{old('name')}}" name="name" id="name" placeholder="Tên mã giảm giá">
                                            @error('name')
                                                <span class="text-danger validate">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="input-form mb-3">
                                            <input style="font-size: 20px !important;height: 40px !important;margin-bottom:8px;" class="form-control @error('voucher_code') is-invalid @enderror" type="text" value="{{old('voucher_code')}}" name="voucher_code" id="voucher_code" placeholder="Voucher code">
                                            @error('voucher_code')
                                                <span class="text-danger validate">{{ $message }}</span><br>
                                            @enderror
                                            <button id="btnRandom" class="btn btn-outline-secondary btn-space" style="width: 120px;" type="button">Ngẫu nhiên</button>
                                        </div>
                                        <div class="input-form mb-5">
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="3" placeholder="Mô tả mã giảm giá">{{old('description')}}</textarea>
                                            @error('description')
                                                <span class="text-danger validate">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <div style="background: #FFF;font-weight: 500;display: flex;align-items: center;border: 1px solid silver;border-bottom: 0px;">
                                            <div class="title-data">Dữ liệu phiếu giảm giá</div>
                                        </div>
                                        <div class="tab-container tab-left" style="border: 1px solid silver;background: #ffffff !important;display: flex;">
                                            <ul class="nav nav-tabs nav-tabs-classic" id="nav-bb" role="tablist" style="width: 200px;display: block;">
                                                <li style="border-bottom:1px solid silver;" class="nav-item"><a style="color: #666 !important;font-size:14px;" class="nav-link active" href="#icon1" data-toggle="tab" role="tab">Tổng quan @error('quanlity') <span class="text-danger">*</span> @enderror</a></li>
                                                <li style="border-bottom:1px solid silver;" class="nav-item"><a style="color: #666 !important;font-size:14px;" class="nav-link" href="#icon2" data-toggle="tab" role="tab">Hạn chế sử dụng @error('condition') <span class="text-danger">*</span> @enderror</a></li>
                                                <li style="border-bottom:1px solid silver;" class="nav-item"><a style="color: #666 !important;font-size:14px;" class="nav-link" href="#icon3" data-toggle="tab" role="tab">Thời hạn sử dụng @error('date_start') <span class="text-danger">*</span> @enderror</a></li>
                                            </ul>
                                            <div class="tab-content m-0 w-100" style="height: 100%;border-left: 1px solid silver;border-radius: 0px;min-height: 200px;display: block;padding: 20px;">
                                                <div class="tab-pane active" id="icon1" role="tabpanel">
                                                    <div class="row mb-3" style="display: flex;align-items: baseline;">
                                                        <label class="col-2" for="value">Loại giảm giá</label>
                                                        <select class="form-control form-control-xs col-5" name="value" id="value">
                                                            <option value="Cố định">Giảm theo giá cố định.</option>
                                                            <option value="Phần trăm">Giảm theo phần trăm đơn.</option>
                                                        </select>
                                                        <div class="col-5 text-secondary">
                                                            <i id="valueICON" title="Giảm giá theo phần trăm hoặc giá trị cố định." class="zmdi zmdi-notifications mr-3"></i>
                                                            <span class="text-danger validate" id="valiValue"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" style="display: flex;align-items: baseline;">
                                                        <label class="col-2" for="">Số lượng</label>
                                                        <input class="form-control form-control-xs col-5 @error('quanlity') is-invalid @enderror" type="number" value="{{old('quanlity')}}" name="quanlity" id="quanlity">
                                                        <div class="col-5 text-secondary">
                                                            <i id="quantityICON" title="Số lượng mã giảm giá có thể sử dụng." class="zmdi zmdi-notifications mr-3"></i>
                                                            <span class="text-danger validate" id="vliQuali">
                                                                @error('quanlity')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                    </div>
                                                    {{-- Giảm cố định --}}
                                                    <div style="display: none;" id="mucGiam">
                                                        <div class="row mb-3" style="display: flex;align-items: baseline;">{{------}}
                                                            <label class="col-2" for="mucGiamIP">Mức giảm</label>
                                                            <div class="col-5 p-0" style="position: relative;display: flex;align-items: center;justify-content: flex-end;">
                                                                <input class="form-control form-control-xs @error('decreased_value') is-invalid @enderror" style="padding-right: 24px;" type="number" name="decreased_value" value="{{old('decreased_value')}}" id="mucGiamIP">
                                                                <span class="price-item" style="position: absolute;margin: 6px 9px;">₫</span>
                                                            </div>
                                                            <div class="col-5 text-secondary">
                                                                <i id="decreased_valueICON" title="Mức giảm giá của voucher." class="zmdi zmdi-notifications mr-3"></i>
                                                                <span class="text-danger validate" id="valimucGiamIP">
                                                                    @error('decreased_value')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Giảm phần trăm --}}
                                                    <div style="display: none;" id="toiDa">
                                                        <div class="row mb-3" style="display: flex;align-items: baseline;" id="">{{------}}
                                                            <label class="col-2" for="toiDaIP_1">Phần trăm giảm</label>
                                                            <div class="col-5 p-0" style="position: relative;display: flex;align-items: center;justify-content: flex-end;">
                                                                <input class="form-control form-control-xs @error('decreased_value') is-invalid @enderror" style="padding-right: 24px;" type="number" name="decreased_value" value="{{old('decreased_value')}}" id="toiDaIP_1">
                                                                <span class="price-item" style="position: absolute;margin: 6px 9px;">%</span>
                                                            </div>
                                                            <div class="col-5 text-secondary">
                                                                <i id="toiDaIP_1ICON" title="Phần trăm giảm giá của voucher." class="zmdi zmdi-notifications mr-3"></i>
                                                                <span class="text-danger validate" id="valitoiDaIP_1">
                                                                    @error('decreased_value')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3" style="display: flex;align-items: baseline;">{{------}}
                                                            <label class="col-2" for="toiDaIP_2">Mức giảm tối đa</label>
                                                            <div class="col-5 p-0" style="position: relative;display: flex;align-items: center;justify-content: flex-end;">
                                                                <input class="form-control form-control-xs @error('max_value') is-invalid @enderror" style="padding-right: 24px;" type="number" name="max_value" value="{{old('max_value')}}" id="toiDaIP_2">
                                                                <span class="price-item" style="position: absolute;margin: 6px 9px;">₫</span>
                                                            </div>
                                                            <div class="col-5 text-secondary">
                                                                <i id="toiDaIP_2ICON" title="Mức giảm giá tối đa của voucher." class="zmdi zmdi-notifications mr-3"></i>
                                                                <span class="text-danger validate" id="valitoiDaIP_2">
                                                                    @error('max_value')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="icon2" role="tabpanel">
                                                    <div class="row mb-3" style="display: flex;align-items: baseline;">
                                                        <label class="col-2" for="condition">Điều kiện tối thiểu</label>
                                                        <div class="col-5 p-0" style="position: relative;display: flex;align-items: center;justify-content: flex-end;">
                                                            <input class="form-control form-control-xs @error('condition') is-invalid @enderror" style="padding-right: 24px;" type="number" name="condition" value="{{old('condition')}}" id="condition">
                                                            <span class="price-item" style="position: absolute;margin: 6px 9px;">₫</span>
                                                        </div>
                                                        <div class="col-5 text-secondary">
                                                            <i id="conditionICON" title="Áp dụng cho các đơn hàng có giá trị thanh toán tối thiểu." class="zmdi zmdi-notifications mr-3"></i>
                                                            <span class="text-danger validate" id="valicondition">
                                                                @error('condition')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" style="display: flex;align-items: baseline;">
                                                        <label class="col-2" for="">Chú ý:</label>
                                                        <div class="col-5 p-0" style="position: relative;display: flex;align-items: center;">
                                                            <div>Chỉ áp dụng cho các đơn có giá trị <span style="color: #21618c;font-weight: 400;">thanh toán</span> lớn hơn hoặc bằng điều kiện.</div>
                                                        </div>
                                                        <div class="col-5 text-secondary"><span class="text-danger validate" ></span></div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="icon3" role="tabpanel">
                                                    <div class="row mb-3" style="display: flex;align-items: baseline;">
                                                        <label class="col-2" for="">Ngày bắt đầu</label>
                                                        <input class="form-control form-control-xs col-5 @error('date_start') is-invalid @enderror" type="date" value="{{old('date_start')}}" name="date_start" id="date_start">
                                                        <div class="col-5 text-secondary">
                                                            <i id="date_startICON" id="dateST" title="Ngày bắt đầu hoạt động của mã." class="zmdi zmdi-notifications mr-3"></i>
                                                            <span class="text-danger validate" id="valiDate_start">
                                                                @error('date_start')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" style="display: flex;align-items: baseline;">
                                                        <label class="col-2" for="">Ngày kết thúc</label>
                                                        <input class="form-control form-control-xs col-5 @error('date_end') is-invalid @enderror" type="date" value="{{old('date_end')}}" name="date_end" id="date_end">
                                                        <div class="col-5 text-secondary">
                                                            <i id="date_endICON" id="dateEN" title="Ngày kết thúc hoạt động của mã." class="zmdi zmdi-notifications mr-3"></i>
                                                            <span class="text-danger validate" id="valiDate_end">
                                                                @error('date_end')
                                                                    {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 p-0">
                                    <div class="card">
                                        <div class="card-header m-0 p-0">
                                            <div class="card-title m-0" style="height: 37px !important;display: flex;align-items: center;padding: 8px 12px;border: 1px solid silver;font-size: 16px;font-weight: 500;">
                                                Đăng mã
                                            </div>
                                        </div>
                                        <div class="card-body p-0" style="border-bottom:1px solid silver;border-left:1px solid silver;border-right:1px solid silver;border-radius: 0px;">
                                            <div style="padding: 6px 10px 8px;display: flex;align-items: center;">
                                                <div style="font-size: 16px;color: gray;padding-right: 3px;">
                                                    <i class="fa fa-tags"></i>
                                                </div>
                                                <div style="display: flex; align-items: center;gap: 4px">
                                                    <strong>Trang thái: </strong>
                                                    <div style="padding: 6px 9px;color: #6495ED;">Khởi tạo</div>
                                                </div>
                                            </div>
                                            <div style="padding: 6px 10px 8px;display: flex;align-items: center;">
                                                <div style="font-size: 16px;color: gray;padding-right: 3px;">
                                                    <i class="fa fa-eye"></i>
                                                </div>
                                                <div style="display: flex; align-items: center;gap: 4px">
                                                    <strong>Hiển thị: </strong>
                                                    <div>
                                                        <select class="form-control form-control-xs" name="type_code" id="type_code" style="height: 30px;border: none;box-shadow: none;">
                                                            <option selected value="Công khai">Công khai</option>
                                                            <option value="Cá nhân">Cá nhân</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="border: 1px solid silver;border-top: none;padding: 8px 12px;">
                                            <div style="display: flex;align-items: center;justify-content: space-between;">
                                                <div>
                                                    <a class="text-danger" style="text-decoration: underline;" href="{{ route('admin.voucher.index') }}">Quay lại danh sách</a>
                                                </div>
                                                <div>
                                                    <button type="submit" class="btn btn-info">Đăng mã</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" id="Choose_Users" style="display: none;">
                                        <div class="card-header m-0 p-0">
                                            <div class="card-title m-0" style="height: 37px !important;display: flex;align-items: center;padding: 8px 12px;border: 1px solid silver;font-size: 16px;font-weight: 500;justify-content: space-between;">
                                                <span>Người dùng</span>
                                                <button class="au-btn au-btn-icon au-btn--green au-btn--small" style="padding: 4px 8px;height: 24px;font-size: 13px;display: flex;align-items: center;" type="button" data-toggle="modal" data-target="#addColorModal">Chọn</button>
                                            </div>
                                        </div>
                                        <div class="card-body p-0" id="list-user" style="border-bottom:1px solid silver;border-left:1px solid silver;border-right:1px solid silver;border-radius: 0px;">
                                            <div style="padding: 8px 10px;">
                                                <div>Số lượng người nhận: <span style="color: #21618c;font-size: 14px;font-weight: 500;" id="quatityUser">0</span></div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 700px !important;">
                                                <div class="modal-content" style="margin-top: 80px;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addColorModalLabel">Danh sách khách hàng</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            @forelse ($users as $key=>$user)
                                                                <div class="col-6">
                                                                    <label for="user_{{$user->id}}" class="user-item" style="border: 1px solid #e7e7e782; border-radius: 4px;">
                                                                        <div class="user-image">
                                                                            <img class="img-item" width="50px" height="50px" src="https://i.pinimg.com/736x/51/e8/41/51e841c0193ee856e1a33a14c9f3e5f2.jpg" style="border-radius: 50%;border: 1px solid silver;">
                                                                        </div>
                                                                        <div class="ii-m">
                                                                            <div style="margin: 0px 10px;">
                                                                                <h3 class="user-name">{{ $user->name }}</h3>
                                                                                <div class="user-email">{{ $user->email }}</div>
                                                                            </div>
                                                                            <div class="button-end">
                                                                                <input type="checkbox" class="checkbox" value="{{ $user->id }}" data-id="{{ $user->id }}" name="users_id[{{$key++}}]" id="user_{{$user->id}}">
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            @empty
                                                                <img src="{{ asset('assets/client/bootstrap/fonts/no-data.svg') }}">
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--  --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @php
        echo '<script>
        var usersData = ' . json_encode($users) . ';
        </script>';
    @endphp
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            // 
                $(document).on('change', '#value', function () {
                    loadCp();
                });
                $(document).on('change', '#quantity', function () {
                    loadPr();
                });
                $(document).on('change', '#mucGiamIP', function () {
                    loadMg();
                });
                $(document).on('change', '#toiDaIP_1', function () {
                    loadPt();
                });
                $(document).on('change', '#toiDaIP_2', function () {
                    loadPm();
                });
                $(document).on('change', '#condition', function () {
                    loadDk();
                });
                $(document).on('click', '#btnRandom', function () {
                    $('#voucher_code').val(generateRandomPassword(10));
                });
                $(document).on('change', '#date_start', function () {
                    loadSr();
                });
                $(document).on('change', '#date_end', function () {
                    loadEd();
                });
                $(document).on('click', '#valueICON', function () {
                    $('#valiValue').text("Giảm giá theo phần trăm hoặc giá trị cố định.");
                    setTimeout(() => {
                        $('#valiValue').text("");
                    }, 5000);
                });
                $(document).on('click', '#quantityICON', function () {
                    $('#vliQuali').text("Số lượng mã giảm giá có thể sử dụng.");
                    setTimeout(() => {
                        $('#vliQuali').text("");
                    }, 5000);
                });
                $(document).on('click', '#decreased_valueICON', function () {
                    $('#valimucGiamIP').text("Mức giảm giá của voucher.");
                    setTimeout(() => {
                        $('#valimucGiamIP').text("");
                    }, 5000);
                });
                $(document).on('click', '#toiDaIP_1ICON', function () {
                    $('#valitoiDaIP_1').text("Phần trăm giảm giá của voucher.");
                    setTimeout(() => {
                        $('#valitoiDaIP_1').text("");
                    }, 5000);
                });
                $(document).on('click', '#toiDaIP_2ICON', function () {
                    $('#valitoiDaIP_2').text("Mức giảm giá tối đa của voucher.");
                    setTimeout(() => {
                        $('#valitoiDaIP_2').text("");
                    }, 5000);
                });
                $(document).on('click', '#conditionICON', function () {
                    $('#valicondition').text("Điều kiện để sử dụng mã giảm giá.");
                    setTimeout(() => {
                        $('#valicondition').text("");
                    }, 5000);
                });
                $(document).on('click', '#date_startICON', function () {
                    $('#valiDate_start').text("Ngày bắt đầu hoạt động của mã.");
                    setTimeout(() => {
                        $('#valiDate_start').text("");
                    }, 5000);
                });
                $(document).on('click', '#date_endICON', function () {
                    $('#valiDate_end').text("Ngày kết thúc hoạt động của mã.");
                    setTimeout(() => {
                        $('#valiDate_end').text("");
                    }, 5000);
                });
            // 
            $(document).on('change', '#type_code', function () {
                if ($(this).val() == "Cá nhân") {
                    $('#Choose_Users').css("display", "block");
                }
                else {
                    $('#Choose_Users').css("display", "none");
                }
            });
        });
    </script>
    <script>
        loadCp();
        function loadCp() {
            const value = document.querySelector('#value');
            const mucGiam = document.querySelector('#mucGiam');
            const toiDa = document.querySelector('#toiDa');
            if(value.value == "Cố định") {
                document.querySelector('#mucGiamIP').disabled = false;
                document.querySelector('#toiDaIP_1').disabled = true;
                document.querySelector('#toiDaIP_2').disabled = true;
                mucGiam.style.display = "block";
                toiDa.style.display = "none";
            }
            else {
                document.querySelector('#toiDaIP_1').disabled = false;
                document.querySelector('#toiDaIP_2').disabled = false;
                document.querySelector('#mucGiamIP').disabled = true;
                toiDa.style.display = "block";
                mucGiam.style.display = "none";
                
            }  
        }
        function loadMg () {
            const mucGiamIP = document.querySelector('#mucGiamIP');
            if(mucGiamIP.value < 0) {
                document.querySelector('#valimucGiamIP').innerText = "Mức giảm không hợp lệ!";
                mucGiamIP.value = 0;
                setTimeout(() => {
                    document.querySelector('#valimucGiamIP').innerText = "";
                }, 3000);
            }
        }
        function loadPt () {
            const toiDaIP_1 = document.querySelector('#toiDaIP_1');
            if(toiDaIP_1.value < 0) {
                document.querySelector('#valitoiDaIP_1').innerText = "Phần trăm không thể âm!";
                toiDaIP_1.value = 0;
                setTimeout(() => {
                    document.querySelector('#valitoiDaIP_1').innerText = "";
                }, 3000);
            }
            else if(toiDaIP_1.value > 100) {
                document.querySelector('#valitoiDaIP_1').innerText = "Phần trăm đã tối đa!";
                toiDaIP_1.value = 100;
                setTimeout(() => {
                    document.querySelector('#valitoiDaIP_1').innerText = "";
                }, 3000);
            }
        }
        function loadPm () {
            const toiDaIP_2 = document.querySelector('#toiDaIP_2');
            if(toiDaIP_2.value < 0) {
                document.querySelector('#valitoiDaIP_2').innerText = "Mức giảm không hợp lệ!";
                toiDaIP_2.value = 0;
                setTimeout(() => {
                    document.querySelector('#valitoiDaIP_2').innerText = "";
                }, 3000);
            }
        }
        function loadPr() {
            const quantity = document.querySelector('#quantity');
            if(quantity.value < 0) {
                document.querySelector('#vliQuali').innerText = "Số lượng không hợp lệ!";
                quantity.value = 0;
                setTimeout(() => {
                    document.querySelector('#vliQuali').innerText = "";
                }, 3000);
            }
            else {
                document.querySelector('#vliQuali').innerText = "";
            }
        }
        function loadDk() {
            const condition = document.querySelector('#condition');
            if(condition.value < 0) {
                document.querySelector('#valicondition').innerText = "Điều kiện không hợp lệ!";
                condition.value = 0;
                setTimeout(() => {
                    document.querySelector('#valicondition').innerText = "";
                }, 3000);
            }
            else {
                document.querySelector('#valicondition').innerText = "";
            }
        }
        function loadSr() {
            const date_start = document.querySelector('#date_start');
            const date = new Date();
            const today = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+(date.getDate());
            
            if(date_start.value < today) {
                document.querySelector('#valiDate_start').innerText = "Ngày không hợp lệ!";
                date_start.value = null;
                setTimeout(() => {
                    document.querySelector('#valiDate_start').innerText = "";
                }, 3000);
            }
            else if (document.querySelector('#date_end').value < date_start.value) {
                document.querySelector('#valiDate_end').innerText = "";
                date_end.value = document.querySelector('#date_start').value;
                setTimeout(() => {
                    document.querySelector('#valiDate_end').innerText = "";
                }, 3000);
            }
            else {
                document.querySelector('#valiDate_start').innerText = "";
            }
        }
        function loadEd() {
            const date_end = document.querySelector('#date_end');
            const date = new Date();
            const today = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+(date.getDate());
            if(date_end < today) {
                document.querySelector('#valiDate_end').innerText = "Ngày không hợp lệ!";
                date_end.value = null;
                setTimeout(() => {
                    document.querySelector('#valiDate_end').innerText = "";
                }, 3000);
            }
            else if (date_end.value < document.querySelector('#date_start').value) {
                document.querySelector('#valiDate_end').innerText = "Ngày kết thúc không thể nhỏ hơn ngày bắt đầu!";
                date_end.value = document.querySelector('#date_start').value;
                setTimeout(() => {
                    document.querySelector('#valiDate_end').innerText = "";
                }, 3000);
            }
            else {
                document.querySelector('#valiDate_end').innerText = "";
            }
        }
    </script>
    <script>
        function getRandomChar(chars) {
            return chars.charAt(Math.floor(Math.random() * chars.length));
        }
        function generateRandomString(length, chars) {
            let result = '';
            for (let i = 0; i < length; i++) {
                result += getRandomChar(chars);
            }
            return result;
        }
        function generateRandomPassword(length) {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            return generateRandomString(length, chars);
        }
    </script>
    <script>
        let selectedUsers = [];
        $(document).ready(function() {
        $('input[type="checkbox"]').change(function() {
            const userId = $(this).data('id');
            const isChecked = $(this).is(':checked');
            if (isChecked) {
                selectedUsers.push(userId);
            } else {
                const index = selectedUsers.indexOf(userId);
                if (index !== -1) {
                    selectedUsers.splice(index, 1);
                }
            }
            $('#quatityUser').html(selectedUsers.length);
            $('body').on('click', '.btn-cancel', function () {
                const userId = $(this).data('id');
                $(`#user_${userId}`).prop('checked', false);
                const index = selectedUsers.indexOf(userId);
                if (index !== -1) {
                    selectedUsers.splice(index, 1);
                    $('#quatityUser').html(selectedUsers.length);
                }
            });
        });
        });
    </script>
@endsection