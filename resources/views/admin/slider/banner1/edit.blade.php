@extends('admin.layouts.master')
@section('title')
    {{$title}}
@endsection
@section('content')
<div class="content">
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Quản lý Banner 1</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.slider.banner1.update', $banner->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ten_baner" class="form-label">Tên Banner</label>
                                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                                               value="{{ $banner->title }}"
                                               placeholder="Tên banner">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="hinh_anh">Hình Ảnh</label>
                                        <input type="file" id="image" name="image" class="form-control" onchange="showImage(event)">
                                        <img id="img_banner" src="{{ url('storage/', $banner->image) }}" style="width: 200px" alt="Hình ảnh banner">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="status">Trạng Thái</label>
                                        <div>
                                            <input type="radio" id="status_show" name="status" value="1" {{ $banner->status == 1 ? 'checked' : '' }}>
                                            <label for="status_show">Hiển thị</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="status_hide" name="status" value="0" {{ $banner->status == 0 ? 'checked' : '' }}>
                                            <label for="status_hide">Ẩn</label>
                                        </div>
                                        @error('status')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function showImage(event) {
        const img_banner = document.getElementById('img_banner');
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function() {
            img_banner.src = reader.result;
            img_banner.style.display = 'block';
        }

        if(file){
            reader.readAsDataURL(file)
        }
    }
</script>
@endsection