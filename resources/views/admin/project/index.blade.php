@extends('admin.layouts.master')
@section('title')
    Project - account
@endsection
@section('css')
    <style>
        .role {
            font-size: 14px;
            color: gray;
        }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-5">
        <div class="card text-center">
            @if (Auth::user()->user_image)
                <img src="{{ Storage::url(Auth::user()->user_image) }}" class="rounded-circle mx-auto d-block mt-3" alt="Profile Image" style="width: 100px; height: 100px;">
            @else
            <img src="/assets/admin/images/icon/avatar-big-01.jpg" class="rounded-circle mx-auto d-block mt-3" alt="Profile Image" style="width: 100px; height: 100px;">
            @endif
            <div class="card-body">
                <h3 class="card-title">{{Auth::user()->name}}</h3>
                <p class="role">Chức vụ: {{Auth::user()->role}}</p>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between">
                Thông tin tài khoản <button class="btn btn-sm btn-info">Sửa</button>
            </div>
            <div class="card-body">
                <p>Email: {{Auth::user()->email}}</p>
                <p>Số điện thoại: {{Auth::user()->phone_number}}</p>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card mt-3">
            <div class="card-header">
                Lịch sử hoạt động
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>

@endsection
@section('js')

@endsection

