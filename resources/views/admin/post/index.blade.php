@extends('admin.layouts.master')

@section('title')
    Quản lý bài viết
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">Bài đăng</h3>
                <div class="au-breadcrumb-content">
                    <form action="{{ route('admin.post.index') }}" class="au-form-icon--sm" action="" method="GET">

                        <input class="au-input--w300 au-input--style2" type="date" name="publish_date"
                            placeholder="Chọn ngày" value="{{ request()->input('publish_date') }}">

                        <input class="au-input--w300 au-input--style2" type="text" name="title"
                            placeholder="Nhập tiêu đề để tìm kiếm." value="{{ request()->input('title') }}">

                        <div class="table-data__tool-right">
                            <button class="au-btn--submit2" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin.post.index') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small mr-2">
                                Xóa tất cả các bộ lọc
                            </button>
                        </a>
                        <a href="{{ route('admin.post.create') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                Thêm bài
                            </button>
                        </a>
                    </div>
                </div>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="rs-select2--light rs-select2--sm"></div>
                    </div>
                </div>
                @if (session('success'))
                    <div>{{ session('success') }}</div>
                @endif
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Tác giả</th>
                                <th>Ngày đăng</th>
                                <th>Lượt xem</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="tr-shadow">
                                    <td>
                                        @if ($post->image)
                                            <img src="{{ \Storage::url($post->image) }}" alt="{{ $post->title }}"
                                                width="150" height="auto">
                                        @endif
                                    </td>
                                    <td class="desc">{{ $post->title }}</td>
                                    <td>{{ $post->content }}</td>
                                    <td>{{ $post->author }}</td>
                                    <td>{{ $post->publish_date }}</td>
                                    <td>{{ $post->views }}</td>
                                    <td>
                                        <a href="{{ route('admin.post.edit', $post->id) }}"
                                            class="zmdi zmdi-edit text-dark">
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                title="Sửa">
                                            </button>
                                        </a>

                                        <form action="{{ route('admin.post.destroy', $post->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="item" data-toggle="tooltip" data-placement="top"
                                                title="Delete" onclick="return confirm('Bạn có muốn xóa bài viết không ?')">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
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
