@extends('layout.admin');
@section('table')
    <!-- DATA TABLE-->

    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Bài đăng</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="property">
                                    <option selected="selected">Lọc theo tiêu đề</option>
                                    <option value="">Option 1</option>
                                    <option value="">Option 2</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <div class="rs-select2--light rs-select2--sm">
                                <select class="js-select2" name="time">
                                    <option selected="selected">Lọc theo ngày</option>
                                    <option value="">3 Days</option>
                                    <option value="">1 Week</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <button class="au-btn-filter">
                                <i class="zmdi zmdi-filter-list"></i>Bộ lọc</button>
                        </div>
                        <div class="table-data__tool-right">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <a href="{{ route('posts.create') }}" >Thêm bài</a>
                            </button>
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
                                    <td >{{ $post->content }}</td>
                                    <td>{{ $post->author }}</td>
                                    <td>{{ $post->publish_date }}</td>
                                    <td>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa">
                                            <a href="{{ route('posts.edit', $post->id) }}" class="zmdi zmdi-edit"></a>
                                        </button>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="item" data-toggle="tooltip"
                                                    data-placement="top" title="Delete">
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
