@extends('client.layouts.master')

@section('title', 'Forgot Password')

@section('text_page')
    Quên Mật Khẩu
@endsection

@section('content')
    @include('client.layouts.components.pagetop')
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="post">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Địa Chỉ Email:</label>
                    <input type="email" id="email" name="email" class="form-control input-lg" placeholder="Nhập email">
                    @error('email')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px;">
                        Gửi liên kết đặt lại mật khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
