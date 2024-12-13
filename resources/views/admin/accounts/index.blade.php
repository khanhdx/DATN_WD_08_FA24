@extends('admin.layouts.master')
@section('title')
    Danh sách người dùng
@endsection
@section('css')
    {{-- CSS --}}
@endsection
@section('content')
    <section class="p-t-20">
        <div class="">
            <div class="row">
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
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Quản lý tài khoản</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            
                            <form action="{{ route('admin.user.index') }}" method="get">
                                @csrf
                                <div class="rs-select2--light rs-select2--md">
                                    <select class="js-select2" name="fillter">
                                        <option value="" selected="selected">Tât cả</option>
                                        <option @if($_GET && $_GET["fillter"] && $_GET["fillter"] == "Khách hàng") selected  @endif value="Khách hàng">Khách hàng</option>
                                        <option @if($_GET && $_GET["fillter"] && $_GET["fillter"] == "Nhân viên") selected  @endif value="Nhân viên">Nhân viên</option>
                                        <option @if($_GET && $_GET["fillter"] && $_GET["fillter"] == "Quản lý") selected  @endif value="Quản lý">Quản lý</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <button class="au-btn-filter" type="submit"><i class="zmdi zmdi-filter-list"></i> Lọc</button>
                            </form>
                        </div>
                        {{-- LT --}}
                        <div class="table-data__tool-right">
                            <a href="{{ route('admin.user.create') }}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                Thêm người dùng <i class="zmdi zmdi-plus"></i></button></a>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
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
                                    @if ($acounts->id !== Auth::user()->id)
                                    <tr class="tr-shadow">
                                        <td>{{$key+1}}</td>
                                        <td>
                                            {{$acounts->name}}
                                        </td>
                                        <td>
                                            @if ($acounts->user_image)
                                                <img src="{{ asset('storage/' . $acounts->user_image) }}" width="35px" height="35px" style="border-radius: 50%; width: 35px; height: 35px;object-fit: cover;">
                                            @else
                                                <img src="{{asset('assets/admin/images/Default_pfp.svg.png')}}" width="35px" height="35px" style="border-radius: 50%; width: 35px; height: 35px;object-fit: cover;">
                                            @endif
                                        </td>
                                        <td>
                                            <span class="block-email">{{$acounts->email}}  </span>
                                        </td>
                                        <td class="desc">
                                            <span>{{$acounts->phone_number ? $acounts->phone_number : "Chưa cập nhật"}}</span>
                                        </td>
                                        <td>
                                            @if ($acounts->role=="Khách hàng")
                                            <span class="role" style="background: #00b5e9">
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
                                                <a href="{{ route('admin.user.edit',$acounts->id) }}" class="mr-1">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <form action="{{ route('admin.user.destroy',$acounts->id) }}" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa người này!')">
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
                                    @endif
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
