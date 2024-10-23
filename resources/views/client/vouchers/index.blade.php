@extends('client.layouts.master')

@section('css')
    <style>
        .voucher-list {
            width: 95%;
            margin: auto;
            padding: 20px;

        }
        .voucher-item {
            display: flex;
            border-radius: 8px;
            box-shadow: 0px 0px 9px #c3c3c3;
        }
        .voucher-icon {
            width: 30%;
            background: rgb(243, 93, 39);
            border-radius: 8px 0px 0px 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .icon {
            font-size: 45px;
            text-align: center;
            border-radius: 50%;
            color: white;
            font-weight: 500;
        }
        .text {
            color: white;
            font-weight:300; 
        }
        .voucher-content {
            width: 50%;
            padding-left: 20px;
            display: flex;
            align-items: center;
        }
        .v-c {
            padding: 20px 0px;
        }
        .voucher-name {
            font-size: 32px;
            color: black;
            font-weight: 700;
            vertical-align: middle;
        }
        .voucher-value {
            color: black;
            font-size: 24px;
            line-height: 28px;
            margin-top: 4px;
        }
        .voucher-status {
            color: orangered;
            border: 1px solid;
            padding: 2px 4px;
            border-radius: 3px;
            line-height: 28px;
            margin-top: 4px;
        }
        .link {
            font-size: 14px;
            font-weight: 600;
            color: #428bca;
            margin-left: 5px;
        }
        .voucher-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 20%;
            padding: 20px;
        }
    </style>
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="header bg-info" style="height: 300px;">
            </div>
        </div>
        <br>
        <div class="container">
            <div class="voucher-body mx-5">
                <div class="card">
                    <div class="card-header">
                        <div class="voucher-title">
                            <h3 class="title" ><span>Voucher mới ra mắt</span></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="voucher-list">
                            <div class="voucher-item">
                                <div class="voucher-icon">
                                    <div>
                                        <div class="icon">
                                            <span>$</span>
                                        </div>
                                        <div class="text">
                                            <span>voucher</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="voucher-content">
                                    <div class="v-c">
                                        <div class="voucher-name">
                                            <span>Giảm tối đa 100k</span>
                                        </div>
                                        <div class="voucher-value">
                                            <span>Giảm tới 1000đ</span>
                                        </div>
                                        <div>
                                            <div>
                                                <span class="voucher-status">Chưa diễn ra</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div>
                                                <span>Có hiệu lực từ</span>
                                                <a href="" class="link">Điều kiện</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="voucher-btn">
                                    <div>
                                        <button class="btn btn-primary">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="title"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="bg-danger" style="height: 200px;">

            </div>
        </div>
    </section>
@endsection
@section('js')

@endsection