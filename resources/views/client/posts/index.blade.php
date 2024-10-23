@extends('client.layouts.master')

@section('text_page')
    Blog Masonry
@endsection

@section('content')
    @include('client.layouts.components.pagetop', ['md' => 'md'])

    <div class="container">
        <div class="row">
            <!-- Hiển thị phân trang -->
            <div class="pagination">
                {{ $posts->links() }}
            </div>
            <div class="blog-posts">
                <div class="blog-masonry">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="col-xs-6 col-md-4 post-mansory-item animation">
                                <article class="post post-medium">
                                    <div class="post-image single">
                                        <span class="post-info-act">
                                            <a href="{{ route('client.post.show', $post->id) }}"><i class="fa fa-caret-right"></i></a>
                                        </span>
                                        <a href="{{ route('client.post.show', $post->id) }}">
                                            @if ($post->image)
                                                <img src="{{ \Storage::url($post->image ) }}"
                                                    alt="Image for {{ $post->title }}"
                                                    style="width: 200px; height: auto;">
                                            @else
                                                <p>Không có ảnh</p>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <h3><a href="{{ route('client.post.show', $post->id) }}">{{ $post->title }}</a></h3>
                                        <div class="post-meta">
                                            <span>By <a href="#">{{ $post->author }}</a> in <a
                                                    href="{{ route('client.post.show', $post->id) }}">Blog</a></span>
                                        </div>

                                        <p>{{ $post->content }}</p>

                                        <div class="post-meta post-meta-foot">
                                            <span class="pull-left"><i
                                                    class="fa fa-clock-o"></i>{{ $post->publish_date }}</span>
                                            {{-- <span class="pull-right"><i class="fa fa-comment-o"></i> <a
                                                    href="#">12 Comments</a></span> --}}
                                        </div>

                                        <p class="btn-loadmore text-center">
                                            <a href="{{ route('client.post.show', $post->id) }}" class="btn">
                                                Xem chi tiết
                                            </a>
                                        </p>
                                    </div>

                                </article>

                            </div>
                        @endforeach
                    @else
                        <p>Hiện không có bài viết nào.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
