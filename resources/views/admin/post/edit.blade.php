@extends('admin.layouts.master')
@section('title')
    Quản lý bài viết
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">Chỉnh sửa bài đăng</h3>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <tbody>
                            <tr class="tr-shadow">

                                <div class="table-data__tool-right">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small mb-2">
                                        <a class="" href="{{ route('admin.post.index') }}">Quay lại danh sách</a>
                                    </button>
                                </div>
                                <form action="{{ route('admin.post.update', $post->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="image">Ảnh:</label>
                                        @if ($post->image)
                                            <img src="{{ \Storage::url($post->image) }}" alt="{{ $post->title }}"
                                                width="120" height="auto"><br>
                                        @endif
                                        <input class="au-input au-input--full" type="file" name="image"
                                            accept="image/*">
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Tiêu đề:</label>
                                        <input class="au-input au-input--full" type="text" name="title"
                                            value="{{ $post->title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="content">Nội dung:</label>
                                        <textarea class="au-input au-input--full" name="content" placeholder="Nội dung">{{ $post->content }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="author">Tác giả:</label>
                                        <input class="au-input au-input--full" type="text" name="author"
                                            value="{{ $post->author }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="publish_date">Ngày đăng:</label>
                                        <input class="au-input au-input--full" type="date" name="publish_date"
                                            value="{{ $post->publish_date }}">
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
@endsection
