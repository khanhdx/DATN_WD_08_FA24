@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35 mt-3">Sản phẩm biến thể</h3>
                @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="rs-select2--light rs-select2--md">
                            <select class="js-select2" name="color">
                                <option selected="selected">Màu sắc</option>
                                @foreach ($colors as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <div class="rs-select2--light rs-select2--sm">
                            <select class="js-select2" name="size">
                                <option selected="selected">Size</option>
                                @foreach ($sizes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <button class="au-btn-filter">
                            <i class="zmdi zmdi-filter-list"></i>Lọc</button>
                    </div>
                    <form class="au-form-icon" action="" method="GET">
                        <input class="au-input--w300 au-input--style2" name="search" value="{{ request('search') }}"
                            type="text" placeholder="Tìm kiếm..." />
                        <button class="au-btn--submit2" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                    {{-- <div class="table-data__tool-right">
                        <a href="{{ route('admin.products.create') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Create</button>
                        </a> --}}

                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Các thuộc tính</th>
                                <th>Số lượng</th>
                                <th>Giá biến thể</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($variants as $item)
                                <tr class="tr-shadow">
                                    <td>{{ $item['id'] }}</td>
                                    {{-- Xử lý ảnh --}}
                                    {{-- <td>
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="" width="100px">
                                    </td> --}}
                                    <td>{{ $item->product->name }}</td>
                                    <td>
                                        <ul>
                                            <li><span class="fw-bold">Màu sắc: </span>{{ $item->color->name }}</li>
                                            <li><span class="fw-bold">Size: </span>{{ $item->size->name }}</li>
                                        </ul>
                                    </td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td class="desc">{{ $item->price }}</td>
                                    <td> 
                                        <div class="table-data-feature">

                                            
                                            {{-- Xem chi tiết  --}}
                                            <a href="{{ route('admin.products.variants.detail', $item->id) }}"> <button class="item mr-2"
                                                    data-toggle="tooltip" data-placement="top" title="Xem chi tiết sản phẩm">
                                                    <i class="fas fa-eye"></i>
                                                </button></a>

                                            {{-- Sửa sản phẩm --}}
                                            <a href="{{ route('admin.products.variants.edit', $item->id) }}"> <button class="item mr-2"
                                                    data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button></a>

                                            {{-- Xóa sản phẩm  --}}
                                            <form action="{{ route('admin.category.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection