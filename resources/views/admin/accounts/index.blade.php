@extends('admin.admin')
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
                    <h3 class="title-5 m-b-35">Quản lý tài khoản</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <form action="{{ route('user.index') }}" method="get">
                                @csrf
                                <div class="rs-select2--light rs-select2--md">
                                    <select class="js-select2" name="fillter">
                                        <option value="" selected="selected">Tât cả</option>
                                        <option value="Khách hàng">Khách hàng</option>
                                        <option value="Nhân viên">Nhân viên</option>
                                        <option value="Quản lý">Quản lý</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <button class="au-btn-filter" type="submit"><i class="zmdi zmdi-filter-list"></i> Lọc</button>
                            </form>
                        </div>
                        {{-- LT --}}
                        <div class="table-data__tool-right">
                            <a href="{{ route('user.create') }}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Thêm người dùng</button></a>
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
                                @foreach ($accounts as $key => $acounts)
                                    <tr class="tr-shadow">
                                        <td>
                                            <label class="au-checkbox">
                                                <input  type="checkbox">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            {{$acounts->name}}
                                        </td>
                                        <td>
                                            <img src="{{ Storage::url($acounts->user_image) }}" alt="Ảnh" width="35px" height="35px" style="border-radius: 50%">
                                        </td>
                                        <td>
                                            <span class="block-email">{{$acounts->email}}  </span>
                                        </td>
                                        <td class="desc">
                                            <span class="">{{$acounts->phone_number}}</span>
                                        </td>
                                        <td>
                                            @if ($acounts->role=="Khách hàng")
                                            <span class="role user">
                                                {{$acounts->role}}
                                            </span>
                                            @elseif ($acounts->role=="Nhân viên")
                                            <span class="role member">
                                                {{$acounts->role}}
                                            </span>
                                            @else
                                            <span class="role admin">
                                                {{$acounts->role}}
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('user.edit',$acounts->id) }}" class="mr-1">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <form action="{{ route('user.destroy',$acounts->id) }}" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa người này!')">
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
                        {{ $accounts->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    {{-- JAVA SCRIPT --}}
@endsection
