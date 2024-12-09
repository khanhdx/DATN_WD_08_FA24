@extends('client.layouts.master')

@section('title', 'Mã giảm giá')

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
                <h2><span>Mã giảm giá</span></h2>
            </div>
        </div>
    </section>
    <section id="lookbook">
        <div class="container">
            <div class="title">
                <span>Mã giảm giá mới</span>
            </div>
            <div class="voucher-list">
                @foreach ($voucher_new as $key => $voucher)
                        <div class="card-voucher">
                            <div class="voucher-right">
                                <div class="voucher-name"><span>{{$voucher->name}}</span>|<span>Giảm tối đa {{number_format($voucher->max_value,0,'','.')}}đ</span>|<span>Đơn tối thiểu {{number_format($voucher->condition,0,'','.')}}đ</span></div>
                                <div class="voucher-title">
                                    <span>Gift Coupon</span>
                                </div>
                                <div class="time-line"><span>Còn: {{ $voucher->remaini }}/{{$voucher->quanlity}} lượt sử dụng</span>|<span>Có hiệu lực từ {{$voucher->date_start}}</span> <span><a class="link" href="{{ route('client.voucher.show',$voucher->id) }}">Chi tiết</a></span></div>
                            </div>
                            <div class="voucher-left">
                                <div class="salse">
                                    @if ($voucher->value === "Cố định")
                                        <span>{{ preg_replace('/0{3}$/', 'k', $voucher->decreased_value) }}</span>
                                    @else
                                        <span>{{$voucher->decreased_value}}%</span>
                                    @endif
                                </div>
                                <div>
                                    @if ($voucher->date_start > date('Y-m-d'))
                                        <button class="btn btn-save" disabled>Chưa bắt đầu</button>
                                    @elseif ($voucher->date_end < date('Y-m-d'))
                                        <button class="btn btn-save" disabled>Hết hạn</button>
                                    @elseif ($voucher->remaini == 0)
                                        <button class="btn btn-save" disabled>Hết lượt</button>
                                    @else
                                        @if (Auth::user() && $ware->wares_list)
                                            @if ($ware->wares_list->where('voucher_id',$voucher->id)->first())
                                                <button class="btn btn-save" disabled>Đã lưu</button>  
                                            @else                              
                                                <form class="voucher-form" id="voucherForm{{$voucher->id}}" onsubmit="formVoucher({{$voucher->id}})" action="{{ route('client.voucher.update',$voucher->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="voucher_id" value="{{$voucher->id}}">
                                                    <button class="btn btn-save LuuVoucher">Lưu</button>
                                                </form>
                                            @endif
                                        @else
                                            <button class="btn btn-save saveVoucher">Lưu</button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('js')

@endsection