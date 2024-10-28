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
                <h2><span>Voucher</span></h2>
            </div>
        </div>
    </section>
    <section id="lookbook">
        <div class="container">
            <div class="title">
                <span>New voucher</span>
            </div>
            <div class="voucher-list">
                @foreach ($voucher_new as $voucher)
                    <div class="card-voucher">
                        <div class="voucher-right">
                            <div class="voucher-name"><span>{{$voucher->name}}</span>|<span>Giảm tối đa {{$voucher->max_value}}đ</span>|<span>Đơn tối thiểu {{$voucher->condition}}đ</span></div>
                            <div class="voucher-title">
                                <span>Gift Coupon</span>
                            </div>
                            <div class="time-line"><span>Còn: {{$voucher->quanlity}} lượt sử dụng</span>|<span>Có hiệu lực từ {{$voucher->date_start}}</span> <span><a class="link" href="{{ route('client.voucher.show',$voucher->id) }}">Chi tiết</a></span></div>
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
                                @if (Auth::user())
                                    <form action="{{ route('client.voucher.update',Auth::user()->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-save">Lưu</button>
                                    </form>
                                @else
                                    <button class="btn btn-save">Lưu</button>
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