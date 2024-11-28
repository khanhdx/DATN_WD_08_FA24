@extends('client.layouts.master')

@section('title', 'Chỉnh sửa thông tin')

@section('content')
<div class="container">
    <h2>Chỉnh sửa thông tin cá nhân</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Số điện thoại:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
        </div>

        <div class="form-group">
            <label for="user_image">Hình ảnh:</label>
            <input type="file" class="form-control" id="user_image" name="user_image">
            @if ($user->user_image)
                <img src="{{ asset('storage/' . $user->user_image) }}" alt="Hình ảnh người dùng" style="width: 100px; height: auto;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        
    </form>
    <a href="{{ route('profile.index') }}" class="btn btn-danger">Hủy</a>
</div>
@endsection