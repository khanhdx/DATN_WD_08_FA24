@extends('client.layouts.master')

@section('content')
    <!-- Begin Main -->
    <div role="main" class="main">

        <!-- Begin page top -->
        <section class="page-top-md">
            <div class="container">
                <div class="page-top-in">
                    <h2><span>Blog Masonry</span></h2>
                </div>
            </div>
        </section>
        <!-- End page top -->

        <div class="container">
            <div class="row">
                <div class="blog-posts">
                    <div class="blog-masonry">
                        @if ($posts->count() > 0)
                            @foreach ($posts as $post)
                                <div class="col-xs-6 col-md-4 post-mansory-item animation">
                                    <article class="post post-medium">
                                        <div class="post-image single">
                                            <span class="post-info-act">
                                                <a href="{{ route('client.post_show', $post->id) }}"><i class="fa fa-caret-right"></i></a>
                                            </span>
                                            <a href="{{ route('client.post_show', $post->id) }}">
                                                @if ($post->image)
                                                    <img src="{{ $post->image }}"
                                                        alt="Image for {{ $post->title }}"
                                                        style="width: 200px; height: auto;">
                                                @else
                                                    <p>Không có ảnh</p>
                                                @endif
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <h3><a href="{{ route('client.post_show', $post->id) }}">{{ $post->title }}</a></h3>
                                            <div class="post-meta">
                                                <span>By <a href="#">{{ $post->author }}</a> in <a
                                                        href="{{ route('client.post_show', $post->id) }}">Blog</a></span>
                                            </div>

                                            <p>{{ $post->content }}</p>

                                            <div class="post-meta post-meta-foot">
                                                <span class="pull-left"><i
                                                        class="fa fa-clock-o"></i>{{ $post->publish_date }}</span>
                                                <span class="pull-right"><i class="fa fa-comment-o"></i> <a
                                                        href="#">12 Comments</a></span>
                                            </div>

                                            <p class="btn-loadmore text-center">
                                                <a href="{{ route('client.post_show', $post->id) }}" class="btn">
                                                    Xem chi tiết
                                                </a>
                                            </p>
                                        </div>

                                    </article>

                                </div>
                            @endforeach
                            <!-- Hiển thị phân trang -->
                            <div class="pagination">
                                {{ $posts->links() }}
                            </div>
                        @else
                            <p>Hiện không có bài viết nào.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
