@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35 mt-3">Tồn kho sản phẩm</h3>
                @if (session('success'))
                    <div id="customToast" class="custom-toast">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="rs-select2--light rs-select2--md">
                            <select class="js-select2" name="color">
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <div class="rs-select2--light rs-select2--sm">
                            <select class="js-select2" name="size">
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
                </div> --}}
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th title="Số thứ tự">#</th>
                            <th>Loại</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng thay đổi</th>
                            <th>Ngày thực hiện</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventoryData as $item)
                            <tr class="tr-shadow">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->type }}</td>
                                <td>
                                    <b>{{ $item->product_name }}</b>
                                    <ul>
                                        <li>Màu sắc: {{ $item->color_name }}</li>
                                        <li>Size: {{ $item->size_name }}</li>
                                    </ul>
                                </td>
                                <td>{{ $item->stock_change }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
