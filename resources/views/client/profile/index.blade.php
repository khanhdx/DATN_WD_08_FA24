@extends('client.layouts.master')

@section('css')
    <style>
        .col-md-12 {
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('content')
    <!-- Begin Main -->
    <div role="main" class="main">

        <!-- Begin page top -->
        <section class="page-top-md">
            <div class="container">
                <div class="page-top-in">
                    <h2><span>Trang Cá Nhân</span></h2>
                </div>
            </div>
        </section>
        <!-- End page top -->

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-header text-center">
                        <h2>{{ $user->name }}</h2>
                        <p>{{ $user->email }}</p>
                        <img src="{{ asset('storage/' . $user->user_image) }}" alt="User Image" class="img-circle"
                            style="width: 150px; height: 150px;">
                    </div>

                    <div class="profile-content mt-4">
                        <h4>Thông Tin Liên Hệ</h4>
                        <ul class="list-unstyled">
                            <li><strong>Số Điện Thoại:</strong> {{ $user->phone_number ?? 'Chưa cung cấp' }}</li>
                            <li><strong>Email Đã Xác Minh:</strong>
                                {{ $user->email_verified_at ? 'Đã xác minh' : 'Chưa xác minh' }}</li>
                            <li><strong>{{ $user->role }}</strong></li>
                        </ul>
                    </div>

                    <div class="profile-actions text-center mt-4">
                        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">Chỉnh Sửa Thông Tin</a>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Đăng Xuất</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
