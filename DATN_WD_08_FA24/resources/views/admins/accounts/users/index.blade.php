@extends('layouts.admins')
@section('title')
    Danh sách người dùng
@endsection
@section('css')
    {{-- CSS --}}
@endsection
@section('content')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Quản lý người dùng</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="property">
                                    <option selected="selected">All Properties</option>
                                    <option value="">Option 1</option>
                                    <option value="">Option 2</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <button class="au-btn-filter">
                                <i class="zmdi zmdi-filter-list"></i>filters</button>
                        </div>
                        {{-- LT --}}
                        <div class="table-data__tool-right">
                            <a href="{{ route('user.create','KaHNcsHAfg1') }}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Thêm người dùng</button></a>
                            <a href="{{ route('user.create') }}"><button id="delete" class="au-btn au-btn-icon au-btn--red au-btn--small">
                                <i class="fa-regular fa-trash-can"></i>Xóa</button></a>
                            <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                <select class="js-select2" name="type">
                                    <option selected="selected">Export</option>
                                    <option value="">Option 1</option>
                                    <option value="">Option 2</option>
                                </select>
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
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Ảnh</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Chức vụ</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $user)
                                    <tr class="tr-shadow">
                                        <td>
                                            <label class="au-checkbox">
                                                <input  type="checkbox">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                            <img src="{{ Storage::url($user->user_image) }}" alt="Ảnh" width="150px" style="border-radius: 50%">
                                        </td>
                                        <td>
                                            <span class="block-email">{{$user->email}}  </span>
                                        </td>
                                        <td class="desc">
                                            <span class="">{{$user->phone_number}}</span>
                                        </td>
                                        <td><span class="role user">{{$user->role}}</span></td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    {{-- JAVA SCRIPT --}}
@endsection
