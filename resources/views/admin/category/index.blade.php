@extends('admin.layouts.master')
@section('title')
    Quản lý danh mục
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">Danh mục</h3>
                <div class="table-data__tool">

                    <form class="au-form-icon" action="{{ route('admin.category.index') }}" method="GET">
                        <input class="au-input--w300 au-input--style2" name="search" value="{{ request('search') }}"
                            type="text" placeholder="Nhập từ khóa tìm kiếm" />
                        <button class="au-btn--submit2" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin.category.create') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Thêm danh mục</button>
                        </a>

                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                {{-- <th>Ảnh</th> --}}
                                <th>Tên</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listcategory as $index => $item)
                            <tr class="tr-shadow">
                                <td>{{ $listcategory->firstItem() + $index }}</td>
                                {{-- <td>
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="" width="100px">
                                </td> --}}
                                <td class="desc">{{ $item->name }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('admin.category.edit', $item->id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('admin.category.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Hiển thị phân trang -->
                    <div class="mt-3 ">
                        <nav>
                            {{ $listcategory->links('pagination::bootstrap-5') }}
                        </nav>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
@endsection
