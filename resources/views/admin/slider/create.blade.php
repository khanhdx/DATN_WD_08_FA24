@extends('admin.layouts.master')
@section('title')
    {{$title}}
@endsection
@section('content')
<div class="container-xxl">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Thêm Banner</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary justify-content-center" onclick="addBannerFields()">Thêm Banner Khác</button>
                    <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="bannerFieldsContainer">
                            <div class="banner-fields">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="ten_baner" class="form-label">Tên Banner</label>
                                            <input type="text" name="title[]" class="form-control" placeholder="Tên banner" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Hình Ảnh</label>
                                            <input type="file" name="image[]" class="form-control" onchange="showImage(event)" required>
                                            <img class="banner-image" src="" alt="Hình ảnh banner" style="width: 150px; display:none">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Trạng thái sử dụng</label>
                                            <div>
                                                <input type="radio" name="status[0]" value="active" required> Hiển thị
                                                <input type="radio" name="status[0]" value="inactive" required> Ẩn
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary justify-content-center">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function showImage(event) {
        const img_banner = event.target.nextElementSibling;
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            img_banner.src = reader.result;
            img_banner.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    function addBannerFields() {
        let index = document.querySelectorAll('.banner-fields').length;
        let newFields = `
        <div class="banner-fields">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="ten_banner_${index}" class="form-label">Tên Banner</label>
                        <input type="text" name="title[]" class="form-control" placeholder="Tên banner" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="image_${index}" class="form-label">Hình Ảnh</label>
                        <input type="file" name="image[]" class="form-control" onchange="showImage(event)" required>
                        <img class="banner-image" src="" alt="Hình ảnh banner" style="width: 150px; display:none">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Trạng thái sử dụng</label>
                        <div>
                            <input type="radio" name="status[${index}]" value="active" required> Hiển thị
                            <input type="radio" name="status[${index}]" value="inactive" required> Ẩn
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-danger" onclick="removeBannerField(this)">Xóa Banner</button>
        </div>`;

        const container = document.getElementById('bannerFieldsContainer');
        container.insertAdjacentHTML('beforeend', newFields);
    }

    function removeBannerField(button) {
        button.parentNode.remove();
    }
</script>
@endsection