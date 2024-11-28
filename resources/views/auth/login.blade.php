@extends('client.layouts.master')

@section('title', 'Login')

@section('text_page')
    Đăng Nhập
@endsection

@section('content')
    @include('client.layouts.components.pagetop')
    <div class="container">
        <form action="{{ route('login') }}" method="post">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="email">Địa Chỉ Email:</label>
                <input type="email" id="email" name="email" class="form-control input-lg" placeholder="Nhập Email">
                @error('email')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="inputpassword">Mật Khẩu:</label>
                <input type="password" id="password" name="password" class="form-control input-lg" placeholder="Nhập Mật Khẩu">
                @error('password')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <ul class="list-inline">
                <li>Tạo tài khoản mới? 
                    <a href="{{ route('register') }}" class="text-green">Here <i class="fa fa-hand-o-left"></i></a>
                </li>
            </ul>
            <ul class="list-inline">
                <li><a href="{{ route('password.request') }}" class="text-green">Quên mật khẩu?</a></li>
            </ul>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px;">
                    Đăng Nhập
                </button>
            </div>
        </form>
    </div>
@endsection

