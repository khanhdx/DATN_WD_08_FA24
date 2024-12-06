@extends('client.layouts.master')
@section('css')
<style>
    .voucher-list {
        padding: 0px 10px;
    }
    .card-voucher {
        background: #000000;
        display: grid;
        grid-template-columns: 4fr 1fr;
        color: #FFFFFF;
        margin-bottom: 10px;
    }
    .voucher-right {
        text-align: center;
        padding: 10px;
        font-family: 'circular' !important;
    }
    .voucher-title {
        font-size: 90px;
        font-style: italic;
        font-weight: 700;
    }
    .voucher-left {
        text-align: center;
        border-left: 1px solid gray;
    }
    .voucher-name,.time-line {
        font-weight: bold;
        font-size: 16px;
    }
    .voucher-name span,.time-line span {
        padding: 0px 10px;
    }
    .salse {
        padding: 20px 20px 30px 20px;
        position: relative;
        display: inline-block;
        background-color: #fff;
        color: #000000;
        text-align: center;
        clip-path: polygon(0% -1%, 100% -1%, 100% 100%, 50% 75%, 0% 100%);
        font-family: 'Roboto Slab' !important;
        font-style: italic;
        width: 60%;
        height: 60%;
        font-size: 40px;
    }
    .btn-save {
        margin-top:20px; 
        color: #FFFFFF !important;
        border: 2px solid #FFFFFF !important;
    }
    .link {
        font-size: 16px;
        color: #58e9cc !important;
    }
    .link:hover {
        color: #2FC2A5 !important;
    }
</style>
@endsection
@section('content')
<section class="page-top-lg">
    <div class="container">
        <div class="page-top-in">
            <h2><span>Mã giảm giá của tôi</span></h2>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="table-data__tool">

            </div>
            <div class="table-responsive table-responsive-data2">
                <div class="voucher-list">
                    @foreach ($wares as $key => $ware)
                        <div class="card-voucher">
                            <div class="voucher-right">
                                <div class="voucher-name"><span>{{$ware->voucher->name}}</span>|<span>Giảm tối đa {{number_format($ware->voucher->max_value,0,'','.')}}đ</span>|<span>Đơn tối thiểu {{number_format($ware->voucher->condition,0,'','.')}}đ</span></div>
                                <div class="voucher-title">
                                    <span>Gift Coupon</span>
                                </div>
                                <div class="time-line"><span>Còn: {{$ware->voucher->quanlity}} lượt sử dụng</span>|<span>Có hiệu lực từ {{$ware->voucher->date_start}}</span> <span><a class="link" href="{{ route('client.voucher.show',$ware->voucher->id) }}">Chi tiết</a></span></div>
                            </div>
                            <div class="voucher-left">
                                <div class="salse">
                                    @if ($ware->voucher->value === "Cố định")
                                        <span>{{ preg_replace('/0{3}$/', 'k', $ware->voucher->decreased_value) }}</span>
                                    @else
                                        <span>{{$ware->voucher->decreased_value}}%</span>
                                    @endif
                                </div>
                                <div>
                                    <button class="btn btn-save">{{ $ware->status }}</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection