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
    <div id="contentCC" class="col-5">
        <div class="card text-center">
            @if (Auth::user()->user_image ?? null)
                <img src="{{ asset('storage/' . Auth::user()->user_image) }}" class="rounded-circle mx-auto d-block mt-3" alt="Profile Image" style="width: 100px; height: 100px;object-fit: cover;">
            @else
                <img src="/assets/admin/images/icon/avatar-big-01.jpg" class="rounded-circle mx-auto d-block mt-3" alt="Profile Image" style="width: 100px; height: 100px;object-fit: cover;">
            @endif
            <div class="card-body">
                <h3 class="card-title">{{Auth::user()->name}}</h3>
                <p class="role">Chức vụ: {{Auth::user()->role}}</p>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between">
                Thông tin tài khoản <a href="{{ route('admin.project.edit',Auth::user()->id) }}" id="manual-show" class="btn btn-sm btn-info">Sửa</a>
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
<div class="modal"></div>
@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    <script src="https://kit.fontawesome.com/2e8884d211.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.js" integrity="sha512-kwtW9vT4XIHyDa+WPb1m64Gpe1jCeLQLorYW1tzT5OL2l/5Q7N0hBib/UNH+HFVjWgGzEIfLJt0d8sZTNZYY6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#manual-show', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (res) {
                        dialog = bootbox.dialog({
                            title: 'Chỉnh sửa hồ sơ',
                            message: "<div class='ModalContent'></div>",
                            size: 'large',
                        }); 
                        $('.ModalContent').html(res);
                    }
                });
            });
            $(document).on('click', '#showPassword', function (e) {
                e.preventDefault();
                var pass = $('#validationCustom03');
                pass.attr('type') == 'password' ? pass.attr('type', 'text') : pass.attr('type', 'password');
                console.log($(this).html());
                if ($(this).html() == '<i class="fa-regular fa-eye-slash" aria-hidden="true"></i>') {
                    $(this).html('<i class="fa-regular fa-eye"></i>');
                }
                else {
                    $(this).html('<i class="fa-regular fa-eye-slash"></i>');
                }
            });
            $(document).on('submit','#formEdit', function (e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let data = new FormData($('#formEdit')[0]);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res.status == 400) {
                            $('.errors').html('');
                            $('validationName').html(res.errors.name);
                            $('validationEmail').html(res.errors.email);
                            $('validationPhone').html(res.errors.phone_number);
                        }
                        else {
                            $('.errors').html('');
                            swal("Good job!", "Cập nhật thành công!", "success");
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
@endsection

