@extends('admin.layouts.master')
@section('title')
    {{$title}}
@endsection
@section('content')
<div class="content">
    <div class="container-xxl">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">Quản lý Banner 1</h3>
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <form action="{{ route('admin.slider.banner1.index') }}" method="get">
                        @csrf
                        <div class="rs-select2--light rs-select2--md">
                            <select class="js-select2" name="filter">
                                <option value="" selected="selected">Tất cả</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <button class="au-btn-filter" type="submit"><i class="zmdi zmdi-filter-list"></i> Lọc</button>
                    </form>
                </div>
                <div class="table-data__tool-right">
                    <a href="{{ route('admin.slider.banner1.create') }}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>Thêm Banner 1</button></a>
                    <a href="#"><button id="delete" class="au-btn au-btn-icon btn-danger au-btn--small">
                        <i class="fa-regular fa-trash-can"></i>Xóa</button></a>
                    <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                        <a class="au-btn btn-secondary au-btn--small" href="#">Export</a>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th>
                                <label class="au-checkbox">
                                    <input type="checkbox">
                                    <span class="au-checkmark"></span>
                                </label>
                            </th>
                            <th>#</th>
                            <th>Tên Banner</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listBanner as $item)
                            <tr class="tr-shadow">
                                <td>
                                    <label class="au-checkbox">
                                        <input type="checkbox">
                                        <span class="au-checkmark"></span>
                                    </label>
                                </td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>
                                    <img src="{{url('storage/', $item->image)}}" alt="Banner Image" width="150px">
                                </td>
                                <td><span class="{{ $item->status == 'Hiển thị' ? 'text-success' : 'text-danger' }}">
                                    {{$item->status}}
                                </span></td>
                                <td>
                                    <div class="table-data-feature d-flex align-items-center">
                                        <a href="{{ route('admin.slider.banner1.edit', $item->id) }}" class="mr-1">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('admin.slider.banner1.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có muốn xóa không')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection