@extends('client.layouts.master')

@section('content')
    <div class="post-detail">
        <h1>{{ $post_show->title }}</h1>
        <p>{{ $post_show->content }}</p>

        <!-- Hiển thị ảnh nếu có -->
        @if ($post_show->image)
            <img src="{{ $post_show->image }}" alt="Image for {{ $post_show->title }}" style="width: 400px; height: auto;">
        @else
            <p>Không có ảnh</p>
        @endif

        <p><strong>Tác giả:</strong> {{ $post_show->author }}</p>
        <p><strong>Ngày đăng:</strong> {{ $post_show->publish_date }}</p>
    </div>
@endsection
