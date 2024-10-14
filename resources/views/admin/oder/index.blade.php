@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35 mt-3">Quản lí đơn hàng</h3>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="rs-select2--light rs-select2--sm">
                            <select class="js-select2" name="time">
                                <option selected="selected">Sắp xếp</option>
                                <option value="">Mới nhất</option>
                                <option value="">Cũ nhất</option>
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
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin.products.create') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Thêm</button>
                        </a>

                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Ngày đặt hàng</th>
                                <th>Ghi chú</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái </th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                                <tr class="tr-shadow">
                                    <td>{{ $item->slug}}</td>
                                    <td>{{ $item->user_name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->note }}</td>
                                    <td class="desc">{{ number_format($item->total_price, 0, '', '.') }} đ</td>
                                    <td class="desc">{{ $item->price_sale }}</td>
                                    <td>{{ $item->views }}</td>

                                    <td>
                                        <div class="table-data-feature">

                                            {{-- Thêm biến thể  --}}
                                            <a href="{{ route('admin.products.variants.create', $item->id) }}">
                                                <button class="item mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="Thêm biến thể">
                                                    <i class="fas fa-plus-circle"></i>
                                                </button></a>

                                            {{-- Xem chi tiết  --}}
                                            <a href="{{ route('admin.products.edit', $item->id) }}">
                                                <button class="item mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="Xem chi tiết sản phẩm">
                                                    <i class="fas fa-eye"></i>
                                                </button></a>

                                            {{-- Sửa sản phẩm --}}
                                            <a href="{{ route('admin.products.edit', $item->id) }}">
                                                <button class="item mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button></a>

                                            {{-- Xóa sản phẩm  --}}
                                            <form action="{{ route('admin.products.delete', $item->id) }}" method="POST"
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
