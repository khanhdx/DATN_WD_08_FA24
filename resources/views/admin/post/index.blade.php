@extends('admin.layouts.master');
@section('content')
    <!-- DATA TABLE-->

    <section class="p-t-20">
        <div class="container">
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
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <a class="au-breadcrumb-span" href="{{ route('admin.post.index') }}">Xóa tất cả các bộ lọc</a>
                            </button>
                        </div>
                        <div class="table-data__tool-right">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <a class="au-breadcrumb-span" href="{{ route('admin.post.create') }}">Thêm bài</a>
                            </button>
                        </div>
                    </div>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="rs-select2--light rs-select2--sm">
                            </div>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr-shadow">
                                    @foreach ($posts as $post)
                                <tr>
                                    <td>
                                        @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                                width="100">
                                        @endif
                                    </td>
                                    <td class="desc">{{ $post->title }}</td>
                                    <td>{{ $post->content }}</td>
                                    <td>{{ $post->author }}</td>
                                    <td>{{ $post->publish_date }}</td>
                                    <td>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa">
                                            <a href="{{ route('admin.post.edit', $post->id) }}" class="zmdi zmdi-edit"></a>
                                        </button>
                                        <form action="{{ route('admin.post.destroy', $post->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="item" data-toggle="tooltip" data-placement="top"
                                                title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- END DATA TABLE-->
@endsection
