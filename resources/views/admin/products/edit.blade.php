@extends('admin.layouts.master')

@section('css')
@endsection


@section('content')
    <!-- DATA TABLE-->

    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35 ">Sửa sản phẩm</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <tbody>
                                <tr class="tr-shadow">

                                    <div class="table-data__tool-right mb-3">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <a href="{{ route('admin.products.index') }}">Quay lại danh sách</a>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.products.update', $product['id']) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="title">Tên sản phẩm:</label>
                                            <input class="au-input au-input--full" type="text" name="name"
                                                value="{{ $product['name'] }}" placeholder="Tên sản phẩm">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group ">
                                                    <label for="category">Danh mục:</label>
                                                    <select name="category_id" id="category" class="form-control">
                                                        <option>--- Chọn Danh mục ---</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Mã sản phẩm:</label>
                                                    <input class="au-input au-input--full" type="text" name="SKU"
                                                        value="{{ $product['SKU'] }}" placeholder="Tên sản phẩm">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="title">Giá gốc:</label>
                                                    <input class="au-input au-input--full" type="text"
                                                        name="price_regular" value="{{ $product['price_regular'] }}"
                                                        placeholder="Nhập giá góc">
                                                </div>
                                                <div class="form-group">
                                                    <label for="author">Giá khuyến mãi:</label>
                                                    <input class="au-input au-input--full" type="text" name="price_sale"
                                                        value="{{ $product['price_sale'] }}"
                                                        placeholder="Nhập giá khuyến mãi">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Xử lý update upload ảnh --}}
                                        <div class="form-group">
                                            <label for="title">Ảnh sản phẩm:</label>
                                            <input class="au-input au-input--full" type="file" name="image"
                                                placeholder="Tên sản phẩm">
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Mổ tả ngắn:</label>
                                            {{-- <input class="au-input au-input--full" type="text" name="content" placeholder="Nội dung" > --}}
                                            <textarea class="au-input au-input--full" name="description" placeholder="Mô tả ngắt">{{ $product['description'] }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Mô tả chi tiết</label>
                                            {{-- <input class="au-input au-input--full" type="text" name="content" placeholder="Nội dung" > --}}
                                            <textarea class="au-input au-input--full" name="content" placeholder="Nội dung">{{ $product['content'] }}</textarea>
                                        </div>

                                        <div class="table-data__tool-right">
                                            <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                Cập nhật sản phẩm
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
    
@endsection
