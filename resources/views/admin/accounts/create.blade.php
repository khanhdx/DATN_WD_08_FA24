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
        <div class="container">
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
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Họ & tên" name="name" id="name">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Địa chỉ mail" name="email" id="email">
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone_number">Số điện thoại</label>
                                            <input class="form-control @error('phone_number') is-invalid @enderror" type="text" max="20" name="phone_number" placeholder="Điện thoại" id="phone_number">
                                            @error('phone_number')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="form-label" for="">Loại tài khoản</label>
                                            <select name="role" class="form-control" id="">
                                                <option value="Khách hàng">Khách hàng</option>
                                                <option value="Nhân viên">Nhân viên</option>
                                                <option value="Quản lý">Quản lý</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row w-100">
                                            <div class="col">
                                                <label for="user_image">Ảnh</label>
                                                <input class="form-control p-1 " type="file" name="user_image" id="user_image">
                                            </div>
                                            <div id="file_I" class="col-3">
                                                <img class="p-0" id="view_IMG" src="" alt="Ảnh">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="location">
                                    <div>
                                        <a id="add_location" class="text-light au-btn au-btn-icon au-btn--blue au-btn--small mb-3">Thêm địa chỉ +</a>
                                        <a id="delete_location" style="display: none;" class="text-light au-btn au-btn-icon btn-danger au-btn--small mb-3">Xóa -</a>
                                    </div>
                                    <div class="" id="form_location">

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
        const btn_Add_Location = document.getElementById('add_location');
        const btn_Delete_Location = document.getElementById('delete_location');
        let count = 0;
        btn_Add_Location.addEventListener('click', function() {
            if (count <= 4 && count>=0) {
                count++;
                var form_Element = "";
                btn_Delete_Location.style.display = "inline-block";
                for (let i = 0; i < count; i++) {
                    form_Element = form_Element + `
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="name">Tên địa chỉ</label>
                                <input class="form-control" type="text" name="location[${i}][location_name]" value="Địa chỉ ${i+1}" id="location_name">
                                
                            </div>
                        </div>
                           <div class="row">
                            <div class="col-6 mb-3">
                                <label for="name">Tên người nhận</label>
                                <input class="form-control" type="text" name="location[${i}][user_name]" placeholder="Tên người nhận" id="user_name">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="name">Số điện thoại người nhận</label>
                                <input class="form-control" type="text" name="location[${i}][phone_number]" placeholder="Số điện thoại" id="phone_number">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="name">Địa chỉ người nhận</label>
                                <textarea class="form-control" name="location[${i}][location_detail]" id="" cols="20" rows="5"></textarea>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="name">Đặt làm mặc định</label>
                                <input type="radio" name="status" id="status" value="${i}">
                            </div>
                        </div>
                    `;
                document.getElementById('form_location').innerHTML = form_Element;
                }
            }
            else{
                alert("Tối đa 5 địa chỉ");
            }
            console.log(count);
        });
        btn_Delete_Location.addEventListener('click', function() {
            count = 0;
            if(count == 0){
                btn_Delete_Location.style.display = "none";
            }
            document.getElementById('form_location').innerHTML = "";
        });
    </script>
@endsection
