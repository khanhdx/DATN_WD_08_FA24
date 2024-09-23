@extends('layout.admin');
@section('table')
    <!-- DATA TABLE-->

    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Chỉnh sửa bài đăng</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <tbody>
                                <tr class="tr-shadow">

                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <a href="{{ route('posts.index') }}">Quay lại danh sách</a>
                                        </button>
                                    </div>
                                    <form action="{{ route('posts.update', $post->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="image">Ảnh:</label>
                                            @if ($post->image)
                                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                                    width="100"><br>
                                            @endif
                                            <input class="au-input au-input--full" type="file" name="image"
                                                accept="image/*" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Tiêu đề:</label>
                                            <input class="au-input au-input--full" type="text" name="title"
                                                value="{{ $post->title }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="content">Nội dung:</label>
                                            <input class="au-input au-input--full" type="text" name="content"
                                             {{ $post->content }} required>
                                        </div>

                                        <div class="form-group">
                                            <label for="author">Tác giả:</label>
                                            <input class="au-input au-input--full" type="text" name="author"
                                            value="{{ $post->author }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="publish_date">Ngày đăng:</label>
                                            <input class="au-input au-input--full" type="date" name="publish_date"
                                            value="{{ $post->publish_date }}" required>
                                        </div>

                                        <div class="table-data__tool-right">
                                            <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                Cập nhật bài viết
                                            </button>
                                        </div>
                                    </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- END DATA TABLE-->
@endsection
