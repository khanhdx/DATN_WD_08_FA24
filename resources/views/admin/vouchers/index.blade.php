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
                            <div class="row m-0" style="gap: 10px;">
                                <div class="col p-0">
                                    <label class="m-0 form-label" for="date_start">Từ ngày</label>
                                    <input name="date_start" id="date_start" value="@if(isset($_GET['date_start'])) {{$_GET['date_start']}} @endif" type="date" class="form-control">
                                </div>
                                <div class="col p-0">
                                    <label class="m-0 form-label" for="date_end">Đến ngày</label>
                                    <input name="date_end" id="date_end" value="@if(isset($_GET['date_end'])) {{$_GET['date_end']}} @endif" type="date" class="form-control">
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('admin.voucher.create') }}"><button type="button" class="btn btn-outline-success"><strong>Thêm mới</strong></button></a>
                    </div>
                    
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <th>STT</th>
                                <th>Mã</th>
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
                                        <td>{{$voucher->voucher_code}}</td>
                                        <td>{{$voucher->name}}</td>
                                        <td><div class="type-t">{{$voucher->value}}</div></td>
                                        <td><div class="type-f">{{$voucher->type_code}}</div></td>
                                        <td>{{$voucher->quanlity}}</td>
                                        <td>{{$voucher->date_start}}</td>
                                        <td>{{$voucher->date_end}}</td>
                                        <td><div class="type-s">{{$voucher->status}}</div></td>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    {{-- JAVA SCRIPT --}}

@endsection
