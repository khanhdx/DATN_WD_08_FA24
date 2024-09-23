@extends('layouts.client')

@section('content')
    <div class="post-detail">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
        
        <!-- Hiển thị ảnh nếu có -->
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="Image for {{ $post->title }}" style="width: 400px; height: auto;">
        @else
            <p>Không có ảnh</p>
        @endif

        <p><strong>Tác giả:</strong> {{ $post->author }}</p>
        <p><strong>Ngày đăng:</strong> {{ $post->publish_date }}</p>
    </div>
@endsection