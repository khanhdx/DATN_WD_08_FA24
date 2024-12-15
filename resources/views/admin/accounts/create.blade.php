@extends('admin.layouts.master')
@section('title')
    Tạo người dùng mới
@endsection
@section('css')
    {{-- CSS --}}
    <style>
        #file_I {
            width: 162px;
            height: 162px;
            border-radius: 4px;
            border: 1px black solid;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            padding: 0px;
        }

        #view_IMG {
            margin: 0px;
            padding: 0px;
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 4px;
            display: none;
        }
    </style>
@endsection
@section('content')
    <section class="p-t-20">
        <div class="">
            <div class="box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35">Tạo tài khoản người dùng</h3>
                        <div class="m-3 table-responsive table-responsive-data2">
                            <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label" for="name">Tên người dùng</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Họ & tên" name="name" value="{{ old('name') }}" id="name">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Địa chỉ mail" name="email" value="{{ old('email') }}" id="email">
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone_number">Số điện thoại</label>
                                            <input class="form-control @error('phone_number') is-invalid @enderror" type="text" max="20" name="phone_number" placeholder="Điện thoại" value="{{ old('phone_number') }}" id="phone_number">
                                            @error('phone_number')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="">Loại tài khoản</label>
                                            <select name="role" class="form-control" id="">
                                                <option value="Khách hàng">Khách hàng</option>
                                                <option value="Quản lý">Quản lý</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="password">Mật khẩu</label>
                                            <div class="input-group">
                                                <input class="form-control @error('password') is-invalid @enderror" type="password" max="20" name="password" placeholder="******" id="password">
                                                <button id="btn_LPass" onclick="togglePassword()" type="button" class="btn btn-secondary">Hiện</button>
                                            </div>

                                            @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row w-100">
                                            <div class="col">
                                                <label for="user_image">Ảnh</label>
                                                <input class="form-control p-1 mb-3" type="file" name="user_image" id="user_image">
                                            </div>
                                            <div id="file_I" class="col-3">
                                                <img class="p-0" id="view_IMG" src="" alt="Ảnh">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="reset" class="au-btn au-btn-icon btn-danger au-btn--small mr-3">Xóa</button>
                                    <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small mr-3">Thêm tài khoản</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    {{-- JAVA SCRIPT --}}
    {{-- LIST ảnh --}}
    <script>
        const imageInput = document.getElementById('user_image');
        const previewImage = document.getElementById('view_IMG');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                };
                previewImage.style.display = "block";
                reader.readAsDataURL(file);
            } else {
                previewImage.src = "";
            }
        });
    </script>
    {{-- form địa chỉ --}}
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const showBtn = document.querySelector('#btn_LPass');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                showBtn.textContent = "Ẩn";
            } else {
                passwordField.type = "password";
                showBtn.textContent = "Hiển thị";
            }
        }
    </script>
@endsection
