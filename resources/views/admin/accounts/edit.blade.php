@extends('admin.layouts.master')
@section('title')
    Cập nhật người dùng
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
        }
        .modal-backdrop {
            z-index: -1;
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
                            <div class="modal-dialog" style="margin-top: 80px;">
                                <div class="modal-content">
                                    <form action="{{ route('admin.location.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 d-block" id="">Địa chỉ</h1>
                                            <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="location_name">Tên địa chỉ</label>
                                                <input class="form-control form-control-sm" id="location_name" name="location_name" placeholder="Tên địa chỉ" type="text">
                                                @error('location_name')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="user_name">Tên người nhận</label>
                                                <input class="form-control form-control-sm" id="user_name" name="user_name" placeholder="Tên người nhận" type="text">
                                                @error('user_name')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone_number">Số điện thoại</label>
                                                <input class="form-control form-control-sm" id="phone_number" name="phone_number" placeholder="Số điện thoại" type="text">
                                                @error('phone_number')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            {{-- <div class="mb-3">
                                                <label for="location_detail">Mô tả địa chỉ</label>
                                                <textarea class="form-control" name="location_detail" id="location_detail" rows="3"></textarea>
                                            </div>
                                            @error('location_detail')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror --}}
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="city">Tỉnh/Thành phố</label>
                                                        <select class="form-control form-control-sm" id="city" name="city" aria-label=".form-select-sm">
                                                            <option value="" selected>Chọn tỉnh thành</option>           
                                                        </select>
                                                        @error('city')
                                                            <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="district">Quận/Huyện</label>
                                                        <select class="form-control form-control-sm" id="district" name="district" aria-label=".form-select-sm">
                                                            <option value="" selected>Chọn quận huyện</option>
                                                        </select>
                                                        @error('district')
                                                            <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col mb-3 p-0">
                                                    <label for="ward">Xã/Phường</label>
                                                    <select class="form-control form-control-sm" id="ward" name="ward" aria-label=".form-select-sm">
                                                        <option value="" selected>Chọn phường xã</option>
                                                    </select>
                                                    @error('ward')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="col mb-3 p-0">
                                                    <label for="detail">Đại chỉ chi tiết</label>
                                                    <textarea class="form-control form-control-sm" name="detail" id="detail" cols="5" rows="3"></textarea>
                                                    @error('detail')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>   
                                            <div class="mb-3">
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
                        @foreach ($locations as $key => $location)
                            @php
                                $local = explode("-", $location->location_detail);//Chia địa chỉ làm các phần
                            @endphp
                            <div class="">
                                <div class="d-flex justify-content-between" style="align-items: center;">
                                    <div class="">
                                        <h5 style="">Tên địa chỉ: {{$location->location_name}}</h5>
                                        <div>
                                            <p>Tên người nhận: {{$location->user_name}}</p>
                                            <p>Địa chỉ: {{$location->location_detail}}</p>
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
                                            <div class="modal-dialog" style="margin-top: 80px;">
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
                                                            <div class="mb-3">
                                                                <label for="location_name">Tên địa chỉ</label>
                                                                <input class="form-control" id="location_name" value="{{ $location->location_name }}" name="location_name" placeholder="Tên địa chỉ" type="text">
                                                                @error('location_name')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="user_name">Tên người nhận</label>
                                                                <input class="form-control" id="user_name" value="{{ $location->user_name }}" name="user_name" placeholder="Tên người nhận" type="text">
                                                                @error('user_name')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone_number">Số điện thoại</label>
                                                                <input class="form-control" id="phone_number" value="{{ $location->phone_number }}" name="phone_number" placeholder="Số điện thoại" type="text">
                                                                @error('phone_number')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3 location-detail">
                                                                <div class="row">
                                                                    <div class="col mb-3">
                                                                        <label for="city_edit_{{$key}}">Tỉnh/Thành phố</label>
                                                                        <select data-city="{{ $local[0] }}" onchange="city_change('{{$key}}')" class="form-control form-control-sm" id="city_edit_{{$key}}" name="city_edit" aria-label=".form-select-sm">
                                                                            <option value="" selected>Chọn tỉnh thành</option>           
                                                                        </select>
                                                                        @error('city_edit')
                                                                            <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label for="district_edit_{{$key}}">Quận/Huyện</label>
                                                                        <select data-district="{{ $local[1] }}" onchange="district_change('{{$key}}')" class="form-control form-control-sm" id="district_edit_{{$key}}" name="district_edit" aria-label=".form-select-sm">
                                                                            <option value="" selected>Chọn quận huyện</option>
                                                                        </select>
                                                                        @error('district_edit')
                                                                            <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col mb-3 p-0">
                                                                    <label for="ward_edit_{{$key}}">Xã/Phường</label>
                                                                    <select data-ward="{{ $local[2] }}" class="form-control form-control-sm" id="ward_edit_{{$key}}" name="ward_edit" aria-label=".form-select-sm">
                                                                        <option value="" selected>Chọn phường xã</option>
                                                                    </select>
                                                                    @error('ward_edit')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col mb-3 p-0">
                                                                    <label for="detail_edit_{{$key}}">Đại chỉ chi tiết</label>
                                                                    <textarea class="form-control form-control-sm" name="detail_edit" id="detail_edit_{{$key}}" cols="5" rows="3">{{ $local[3] }}</textarea>
                                                                    @error('detail_edit')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div> 
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
    {{--  --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        <script>
            var citis = document.getElementById("city");
            var districts = document.getElementById("district");
            var wards = document.getElementById("ward");
            var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json", 
            method: "GET", 
            responseType: "application/json", 
            };
            var promise = axios(Parameter);
            promise.then(function (result) {
                
            renderCity(result.data);
            });

            function renderCity(data) {
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Name);
            }
            citis.onchange = function () {
                district.length = 1;
                ward.length = 1;
                if(this.value != ""){
                const result = data.filter(n => n.Name === this.value);

                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Name);
                }
                }
            };
            district.onchange = function () {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Name === citis.value);
                if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Name);
                }
                }
            };
            }
        </script>
        <script>
            function loadLocal() {
                const location_detail = document.getElementsByClassName('location-detail');
                var Parameter = {
                    url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json", 
                    method: "GET", 
                    responseType: "application/json", 
                };
                var promise = axios(Parameter);
                    promise.then(function (result) {
                        
                    for (let i = 0; i < location_detail.length; i++) {
                        loadCity(result.data, i);
                    }
                });
            }
            function loadCity(data,key) {
                const city_edit = document.getElementById(`city_edit_${key}`);
                const district_edit = document.getElementById(`district_edit_${key}`);
                const ward_edit = document.getElementById(`ward_edit_${key}`);
                for(const i of data) {
                    const city_option = new Option(i.Name, i.Name);
                    if (i.Name == city_edit.dataset.city) {
                        city_option.selected = true;
                        // set district
                        if(city_edit.dataset.city != "") {
                            const result = data.filter(n => n.Name === city_edit.dataset.city);
                            for(const k of result[0].Districts) {
                                const districts_option = new Option(k.Name, k.Name);
                                if (k.Name == district_edit.dataset.district) {
                                    districts_option.selected = true;
                                    const dataCity =  data.filter((n) => n.Name === city_edit.dataset.city);
                                    const dataWards = dataCity[0].Districts.filter(n => n.Name == district_edit.dataset.district)[0].Wards;
                                    for(const w of dataWards) {
                                        const ward_option = new Option(w.Name, w.Name);
                                        if(w.Name == ward_edit.dataset.ward) {
                                            ward_option.selected = true;
                                        }
                                        ward_edit.options[ward_edit.options.length] = ward_option;
                                    }
                                }
                                district_edit.options[district_edit.options.length] = districts_option;
                            }
                        }
                    }
                    city_edit.options[city_edit.options.length] = city_option;
                }
            }
            loadLocal();
        </script>
        <script>
            function city_change(key) {
                const city_edit_ = document.getElementById(`city_edit_${key}`);
                const district_edit_ = document.getElementById(`district_edit_${key}`);
                const ward_edit_ = document.getElementById(`ward_edit_${key}`);
                district_edit_.length = 1;
                ward_edit_.length = 1;
                promise.then(function (res) {
                    const result = (res.data).filter(n => n.Name === city_edit_.value);
                    for (const k of result[0].Districts) {
                        district_edit_.options[district_edit_.options.length] = new Option(k.Name, k.Name);
                    }
                });
            }
            function district_change(key) {
                const city_edit_ = document.getElementById(`city_edit_${key}`);
                const district_edit_ = document.getElementById(`district_edit_${key}`);
                const ward_edit_ = document.getElementById(`ward_edit_${key}`);
                ward_edit_.length = 1;
                promise.then(function (res) {
                    const dataCity = (res.data).filter((n) => n.Name === city_edit_.value);
                    const dataWards = dataCity[0].Districts.filter(n => n.Name === district_edit_.value)[0].Wards;

                    for (const w of dataWards) {
                        ward_edit_.options[ward_edit_.options.length] = new Option(w.Name, w.Name);
                    }
                });
            }
        </script>
@endsection
