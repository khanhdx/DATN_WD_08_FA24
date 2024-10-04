@extends('admin.layouts.master')

@section('css')
@endsection


@section('content')
    <!-- DATA TABLE-->

    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35 ">Thêm biến thể sản phẩm</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <tbody>
                                <tr class="tr-shadow">

                                    <div class="table-data__tool-right mb-3">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <a href="{{ route('admin.products.index') }}">Quay lại danh sách sản phẩm</a>
                                        </button>
                                    </div>
                                    <table class="table table-data2">
                                        <tbody>
                                            <tr class="tr-shadow">
                                                <div class="form-group">
                                                    <label for="title">Tên sản phẩm:</label>
                                                    <input class="au-input au-input--full" type="text" name="name"
                                                        value="{{ $product['name'] }}" placeholder="Tên sản phẩm" disabled>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group ">
                                                            <label for="category">Danh mục:</label>
                                                            <input class="au-input au-input--full" type="text"
                                                                name="SKU" value="{{ $product->category->name }}"
                                                                placeholder="Tên sản phẩm" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title">Mã sản phẩm:</label>
                                                            <input class="au-input au-input--full" type="text"
                                                                name="SKU" value="{{ $product['SKU'] }}"
                                                                placeholder="Tên sản phẩm" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">

                                                            <label for="title">Giá gốc:</label>
                                                            <input class="au-input au-input--full" type="text"
                                                                name="price_regular" value="{{ $product['price_regular'] }}"
                                                                placeholder="Nhập giá góc" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title">Giá khuyến mãi:</label>
                                                            <input class="au-input au-input--full" type="text"
                                                                name="price_regular" value="{{ $product['price_sale'] }}"
                                                                placeholder="Nhập giá góc" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        </tbody>
                                    </table>


                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <tbody>
                                <tr class="tr-shadow">
                                    <form action="{{ route('admin.products.variants.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="product_id" value={{ $product->id }}>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="title">Size:</label>
                                                    <select name="size_id" id="size" class="form-control">
                                                        <option>--- Chọn Size ---</option>
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size->id }}">{{ $size->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Giá biến thể:</label>
                                                    <input class="au-input au-input--full" type="text" name="price"
                                                        placeholder="Nhập giá góc">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="title">Màu sắc:</label>
                                                    <select name="color_id" id="color" class="form-control">
                                                        <option>--- Chọn màu sắc ---</option>
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color->id }}">{{ $color->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    {{-- Trước mắt sẽ dùng thể select để chọn thuộc tính
                                                    Sau phát triển phải vừa chọn và vừa nhập --}}
                                                    {{-- <input class="au-input au-input--full" type="text" name="color_id"> --}}
                                                    {{-- <datalist id="colorList">
                                                       @foreach ($colors as $color)
                                                           <option value="{{ $color->id }}">{{ $color->name}}</option>
                                                       @endforeach 
                                                    </datalist> --}}
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Số lượng sản phẩm biến thể:</label>
                                                    <input class="au-input au-input--full" type="text" name="stock"
                                                        placeholder="Nhập giá góc">
                                                </div>
                                            </div>
                                        <div class="table-data__tool-right">
                                            <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                Thêm biến thể
                                            </button>
                                        </div>

                                    </form>
                                </tr>
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
