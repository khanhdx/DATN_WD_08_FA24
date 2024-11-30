@extends('client.layouts.master')

@section('title', 'Register')

@section('text_page')
    Đăng ký
@endsection

@section('content')
    @include('client.layouts.components.pagetop')
    <div class="container">
        <div class="row">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Tên Của Bạn:</label>
                    <input type="text" id="name" name="name" class="form-control input-lg" placeholder="Nhập tên bạn!">
                    @error('name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Địa Chỉ Email:</label>
                    <input type="email" id="email" name="email" class="form-control input-lg" placeholder="Nhập email!">
                    @error('email')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="inputpassword">Mật Khẩu:</label>
                    <input type="password" id="password" name="password" class="form-control input-lg"
                        placeholder="Nhập mật khẩu">
                    @error('password')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="inputpassword">Xác Nhận Mật khẩu:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control input-lg" placeholder="Nhập xác nhận mật khẩu!">
                    @error('password_confirmation')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px;">Đăng Ký
                    </button>
                </div>
                <ul class="list-inline">
                    <p>
                        Đã có tài khoản? <a href="{{ route('login') }}">Đăng Nhập</a>
                    </p>
                </ul>
            </form>
        </div>
    </div>
@endsection
