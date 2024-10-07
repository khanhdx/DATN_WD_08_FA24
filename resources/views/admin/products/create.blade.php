@extends('admin.layouts.master')

@section('css')
    <style>
        .preview-image {
            width: 100px;
            height: 100px;
            object-fit: cover;

        }

        .input-file {
            width: auto;
            margin-left: 10px;
            flex-grow: 1;
        }
    </style>
@endsection


@section('content')
    <!-- DATA TABLE-->

    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35 ">Thêm sản phẩm</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <tbody>
                                <tr class="tr-shadow">

                                    <div class="table-data__tool-right mb-3">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn- -small">
                                            <a href="{{ route('admin.products.index') }}">Quay lại danh sách</a>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.products.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">Tên sản phẩm:</label>
                                            <input class="au-input au-input--full" type="text" name="name"
                                                placeholder="Tên sản phẩm" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group ">
                                                    <label for="category">Danh mục:</label>
                                                    <select name="category_id" id="category" class="form-control">
                                                        <option>--- Chọn Danh mục ---</option>
                                                        @foreach ($categories as $category)
                                                            <option
                                                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                                value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Mã sản phẩm:</label>
                                                    <input class="au-input au-input--full" type="text" name="SKU"
                                                        placeholder="Tên sản phẩm" value="{{ old('SKU') }}">
                                                    @error('SKU')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="title">Giá gốc:</label>
                                                    <input class="au-input au-input--full" type="text"
                                                        name="price_regular" placeholder="Nhập giá góc"
                                                        value="{{ old('price_regular') }}">
                                                    @error('price_regular')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="author">Giá khuyến mãi:</label>
                                                    <input class="au-input au-input--full" type="text" name="price_sale"
                                                        placeholder="Nhập giá khuyến mãi" value="{{ old('price_sale') }}">
                                                    @error('price_sale')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Ảnh sản phẩm:</label>
                                            <table class="table align-middle table-nowarp mb-0">
                                                <tbody id="image-table-body">
                                                    <tr>
                                                        <td class="d-flex align-item-center">
                                                            <div>
                                                                <img id="preview_0"
                                                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrVLGzO55RQXipmjnUPh09YUtP-BW3ZTUeAA&s"
                                                                    alt="Hình ảnh danh mục" class="preview-image mr-3">
                                                            </div>

                                                            <input type="file" id="image" name="image"
                                                                placeholder="Hình ảnh danh mục"
                                                                class="form-control input-file"
                                                                onchange="previewImage(this, 0)">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Mổ tả ngắn:</label>
                                            {{-- <input class="au-input au-input--full" type="text" name="content" placeholder="Nội dung" > --}}
                                            <textarea class="au-input au-input--full" name="description" placeholder="Mô tả ngắn">{{ old('description')}}</textarea>
                                            @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Mô tả chi tiết</label>
                                            {{-- <input class="au-input au-input--full" type="text" name="content" placeholder="Nội dung" > --}}
                                            <textarea class="au-input au-input--full" name="content" placeholder="Nội dung">{{ old('content')}}</textarea>
                                        </div>

                                        <div class="table-data__tool-right">
                                            <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                Thêm sản phẩm
                                            </button>
                                        </div>


                                    </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- END DATA TABLE-->
@endsection

@section('js')
    <script>
        function showImage(event) {
            const img = document.getElementById('img');

            console.log(img);

            const file = event.target.files[0];

            const reader = new FileReader();

            reader.onload = function() {
                img.src = reader.result;
                img.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function previewImage(input, rowIndex) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById(`preview_${rowIndex}`).setAttribute('src', e.target.result)
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
