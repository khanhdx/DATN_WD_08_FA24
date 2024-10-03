@extends('admin.layouts.master')
@section('title')
    Danh sách người dùng
@endsection
@section('css')
    {{-- CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
                    <div class="m-3">
                        <form action="{{ route('admin.user.update',$user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <a href="{{ route('admin.user.index') }}" class="btn btn-danger">Hủy</a>
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label" for="name">Tên người dùng</label>
                                    <input class="form-control" value="{{$user->name}}" type="text" placeholder="Họ & tên" name="name" id="name">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="email">Email</label>
                                    <input class="form-control" value="{{$user->email}}" type="email" placeholder="Địa chỉ mail" name="email" id="email">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="phone_number">Số điện thoại</label>
                                        <input class="form-control" value="{{$user->phone_number}}" type="text" max="20" name="phone_number" placeholder="Điện thoại" id="phone_number">
                                    </div>
                                    <div>
                                        <label class="form-label" for="">Loại tài khoản</label>
                                        <select name="role" class="form-control" id="">
                                            <option {{$user->role == "Khách hàng"?"selected":""}} value="Khách hàng">Khách hàng</option>
                                            <option {{$user->role == "Nhân viên"?"selected":""}} value="Nhân viên">Nhân viên</option>
                                            <option {{$user->role == "Quản lý"?"selected":""}} value="Quản lý">Quản lý</option>
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
                                            <img class="p-0" id="view_IMG" src="{{ Storage::url($user->user_image) }}" alt="Ảnh">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="locations">
                        <div class="d-flex justify-content-between mt-5 mb-3">
                            <div class="">
                                <h4>Địa chỉ:</h4>
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-info text-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Thêm mới địa chỉ
                                </button>
                            </div>
                        </div>
                        <div class="modal fade" id="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.location.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 d-block" id="">Địa chỉ</h1>
                                            <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <label for="location_name">Tên địa chỉ</label>
                                                <input class="form-control" id="location_name" name="location_name" placeholder="Tên địa chỉ" type="text">
                                            </div>
                                            @error('location_name')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            <div>
                                                <label for="user_name">Tên người nhận</label>
                                                <input class="form-control" id="user_name" name="user_name" placeholder="Tên người nhận" type="text">
                                            </div>
                                            @error('user_name')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            <div>
                                                <label for="phone_number">Số điện thoại</label>
                                                <input class="form-control" id="phone_number" name="phone_number" placeholder="Số điện thoại" type="text">
                                            </div>
                                            @error('phone_number')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            <div>
                                                <label for="location_detail">Mô tả địa chỉ</label>
                                                <textarea class="form-control" name="location_detail" id="location_detail" rows="3"></textarea>
                                            </div>
                                            @error('location_detail')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            <div>
                                                <label for="">Đặt làm mặc định</label>
                                                <input type="checkbox" class="Mặc định" value="Mặc định" name="status">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a type="button" class="btn btn-secondary text-light" data-bs-dismiss="modal">Hủy</a>
                                            <button type="submit" class="btn btn-primary">Thêm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @foreach ($locations as $location)
                            <div class="">
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <h5>Tên địa chỉ: {{$location->location_name}}</h5>
                                        <div>
                                            <p>Tên người nhận: {{$location->user_name}}</p>
                                            <p>Địa chỉ chi tiết: {{$location->location_detail}}</p>
                                            <p>Trạng thái: {{$location->status}}</p>
                                        </div>
                                    </div>
                                    <div class="">
                                        <form action="{{ route('admin.location.destroy',$location->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                            <a class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#loactionUpdate{{$location->id}}">Sửa</a>
                                        </form>
                                        <div class="modal" id="loactionUpdate{{$location->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.location.update',$location->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5 d-block" id="">Địa chỉ</h1>
                                                            <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div>
                                                                <label for="location_name">Tên địa chỉ</label>
                                                                <input class="form-control" id="location_name" value="{{ $location->location_name }}" name="location_name" placeholder="Tên địa chỉ" type="text">
                                                            </div>
                                                            @error('location_name')
                                                                <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                            <div>
                                                                <label for="user_name">Tên người nhận</label>
                                                                <input class="form-control" id="user_name" value="{{ $location->user_name }}" name="user_name" placeholder="Tên người nhận" type="text">
                                                            </div>
                                                            @error('user_name')
                                                                <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                            <div>
                                                                <label for="phone_number">Số điện thoại</label>
                                                                <input class="form-control" id="phone_number" value="{{ $location->phone_number }}" name="phone_number" placeholder="Số điện thoại" type="text">
                                                            </div>
                                                            @error('phone_number')
                                                                <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                            <div>
                                                                <label for="location_detail">Mô tả địa chỉ</label>
                                                                <textarea class="form-control" name="location_detail" id="location_detail" rows="3">{{ $location->location_detail }}</textarea>
                                                            </div>
                                                            @error('location_detail')
                                                                <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                            <div>
                                                                <label for="">Đặt làm mặc định</label>
                                                                <input type="checkbox" class="Mặc định" value="Mặc định" name="status">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a type="button" class="btn btn-secondary text-light" data-bs-dismiss="modal">Hủy</a>
                                                            <button type="submit" class="btn btn-primary">Thêm</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
    {{-- JAVA SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
@endsection
