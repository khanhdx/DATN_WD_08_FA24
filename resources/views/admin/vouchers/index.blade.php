@extends('admin.layouts.master')
@section('title')
    Quản lý mã giảm giá
@endsection
@section('css')
    {{-- CSS --}}
        <style>
            .type-t {
                border: 1px solid #FF00FF;
                border-radius:100px; 
                color: #FF00FF;
                width: 100%;
                padding: 0px 5px;
                background-color: #FFF0F5; 
            }
            .type-f {
                border: 1px solid #1E90FF;
                border-radius:100px; 
                color: #1E90FF;
                width: 100%;
                padding: 0px 5px;
                background-color: #F0FFFF; 
            }
            .type-s {
                border: 1px solid #28a745;
                border-radius:100px; 
                color: #28a745;
                width: 100%;
                padding: 0px 5px;
                background-color: #F0FFF0; 
            }
        </style>
        <style>
            .search-form {
                display: flex;
                position: relative;
            }
            .search-form i {
                font-size: 24px;
                font-weight: bold;
                position: absolute;
                margin-top: -10px; 
                margin-left: -30px;
            }
        </style>
    {{-- Link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
@endsection
@section('content')
    <section class="p-t-20">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Quản lý mã giảm giá</h3>
                    <div class="d-flex justify-content-between mb-3">
                        <form class="" method="GET" style="width: 50%;">
                            <div class="search-form mb-3">
                                <input class="form-control" type="text" name="search" value="@if(isset($_GET['search']) && $_GET['search'] != "") {{$_GET['search']}} @endif" placeholder="Tìm phiếu giảm giá theo tên hoặc mã">
                                <button style="box-shadow: none;" class="btn m-0 p-0"><i class="zmdi zmdi-search"></i></button>
                            </div>
                        </form>
                        <a href="{{ route('admin.voucher.create') }}"><button type="button" class="btn btn-outline-success"><strong>Thêm mới</strong></button></a>
                    </div>
                    
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Kiểu</th>
                                <th>Loại</th>
                                <th>Số lượng</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </thead>
                            <tbody>
                                @foreach ($vouchers as $key=>$voucher)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$voucher->name}}</td>
                                        <td><div class="type-t">{{$voucher->value}}</div></td>
                                        <td><div class="type-f">{{$voucher->type_code}}</div></td>
                                        <td class="@if($voucher->remaini == 0) text-danger @endif">{{$voucher->remaini}}/{{$voucher->quanlity}}</td>
                                        <td>{{$voucher->date_start}}</td>
                                        <td>{{$voucher->date_end}}</td>
                                        <td>
                                                @if (date('Y-m-d') < $voucher->date_start)
                                                    <div class="type-s">
                                                        Chưa diễn ra
                                                    </div>
                                                @elseif ($voucher->date_start <= date('Y-m-d') && $voucher->date_end >= date('Y-m-d'))
                                                    <div class="type-s">
                                                        Đang diễn ra
                                                    </div>
                                                @else
                                                    <div class="type-s" style="border: 1px solid #a72828 !important;color: #a72828 !important;background-color: #fff0f0 !important;">
                                                        Đã kết thúc
                                                    </div>
                                                @endif
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('admin.voucher.edit',$voucher->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>                          
                                @endforeach
                            </tbody>
                        </table>
                        {{ $vouchers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    {{-- JAVA SCRIPT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></script>
    @if (session('success'))
        <script>
            toastr["success"]("{{ session('success') }}", "Thông báo")

            toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "1500",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
        </script>
    @endif
@endsection
