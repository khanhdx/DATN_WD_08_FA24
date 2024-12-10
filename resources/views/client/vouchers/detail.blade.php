@extends('client.layouts.master')

@section('title', 'Chi tiết voucher')

@section('css')
    <style>
        .voucher-list {
            padding: 0px 10px;
            position: relative;
            padding-left: 5%;
            padding-right: 5%;
            padding-top: 50px;
            padding-bottom: -50px;
            width: 100%;
            background-color: gray; 
            height: 200px
        }
        .card-voucher {
            background: #000000;
            display: grid;
            grid-template-columns: 4fr 1fr;
            color: #FFFFFF;
            margin-bottom: 10px;
            position: absolute;
            width: 90%;
            margin: auto;
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
        .content {
            margin-top: 100px; 
        }
        .title {
            text-align: start !important;
            font-size: medium !important;
            margin-bottom: 20px !important;
        }
        .content p{
            margin-left: 40px; 
            margin-bottom:10px; 
            font-family: 'circular';
        }
        .footer-content {
            text-align: center;
            margin: 20px;
        }
        .footer-content button {
            width: 50%;
        }
    </style>
@endsection
@section('content')
    <section id="lookbook">
        <div class="container">
            <div class="voucher-list">
                    <div class="card-voucher">
                        <div class="voucher-right">
                            <div class="voucher-name"><span>{{$voucher->name}}</span>|<span>Giảm tối đa {{$voucher->max_value}}đ</span>|<span>Đơn tối thiểu {{$voucher->condition}}đ</span></div>
                            <div class="voucher-title">
                                <span>Gift Coupon</span>
                            </div>
                            <div class="time-line"><span>Còn:  {{ $voucher->remaini }}/{{$voucher->quanlity}} lượt sử dụng</span>|<span>Có hiệu lực từ {{$voucher->date_start}}</span></div>
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
                                @else
                                    @if (Auth::check())
                                        @if ($voucher->check)
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
            </div>
            <div class="content">
                @php
                    use Carbon\Carbon;
                    $today = Carbon::today();
                @endphp
                <div>
                    <div class="title"><span>Trạng thái</span></div>
                    <p>
                        @if ($voucher->date_start > $today)
                            Chưa diễn ra
                        @elseif ($voucher->date_start <= $today && $voucher->date_end >= $today)
                            Đang diễn ra
                        @else
                            Đã kết thúc
                        @endif
                    </p>
                </div>
                <div>
                    <div class="title"><span>Mã code voucher</span></div>
                    <p>Mã: <span style="font-weight: 600;">{{$voucher->voucher_code}}</span></p>
                </div>
                <div>
                    <div class="title"><span>Hạn sử dụng mã</span></div>
                    <p><span>Từ ngày: {{$voucher->date_start}} - đến hết ngày: {{$voucher->date_end}}</span></p>
                </div>
                <div>
                    <div class="title"><span>Ưu đãi</span></div>
                    <p>Lượt sử dụng có hạn. Nhanh tay kẻo lỡ bạn nhé! Giảm tới: {{$voucher->decreased_value}}đ </p>
                </div>
                <div>
                    <div class="title"><span>Áp dụng cho</span></div>
                    <p>Mã giảm giá được áp dùng cho các đơn hàng thanh toán với giá trị tối thiều: {{$voucher->condition}}đ</p>
                </div>
                <div>
                    <div class="title"><span>Mã giảm giá loại</span></div>
                    <p>{{$voucher->type_code}}: Mọi người đều có thể nhìn thấy và sử dụng nó.</p>
                </div>
                <div>
                    <div class="title"><span>Chi tiết</span></div>
                    <p>{{$voucher->description}}</p>
                </div>
                <div class="footer-content">
                    <a href="{{ route('client.voucher.index') }}">
                        <button class="btn btn-primary">Đã hiểu</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

@endsection