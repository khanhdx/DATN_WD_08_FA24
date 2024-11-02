@extends('client.layouts.master')

@section('title', 'Blog single')

@section('text_page')
    Blog single
@endsection

@section('content')
    @include('client.layouts.components.pagetop', ['md' => 'md'])

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="blog-posts single-post">
                    <article class="post post-large blog-single-post">
                        <h3>{{ $post_show->title }}</h3>
                        <div class="post-meta">
                            <span>By <a href="#">{{ $post_show->author }}</a> in <a href="#">Blog</a></span>
                            <span><i class="fa fa-clock-o"></i> {{ $post_show->publish_date }} </span>
                            <span><i class="fa fa-comment-o"></i> <a href="#">1 Comments</a></span>
                        </div>
                        <div class="post-image single">
                            {{-- <img class="img-responsive" src="images/content/blog/demo-3.jpg" alt="Image"> --}}
                            @if ($post_show->image)
                                <img class="img-responsive" src="{{ \Storage::url($post_show->image) }}"
                                    alt="{{ $post_show->title }}">
                            @else
                                <p>Không có ảnh</p>
                            @endif
                        </div>
                        <div class="post-content">
                            <blockquote>
                                <p>{{ $post_show->content }}</p>
                            </blockquote>
                        </div>
                        {{-- <div class="post-tags">
                            <strong>Tags:</strong> <a href="#">fashion</a> <a href="#">new styles</a>
                        </div> --}}
                        {{-- <ul class="post-action">
                            <li class="btn-pre"><a href="#">Riff Raff Eats Fried Okra With Oprah on 'Dolce &amp;
                                    Gabbana’</a></li>
                            <li class="btn-next"><a href="#">Watch Drunk Riff Raff Freestyle About Failed Hoop
                                    Dreams for 10 Minutes</a></li>
                        </ul> --}}
                        <div class="related-posts">
                            <h3>Bạn cũng có thể thích</h3>
                            <div class="row">
                                @foreach ($recentPosts as $post)
                                    <div class="col-xs-4">
                                        <article class="post">
                                            <div class="post-image">
                                                <a href="{{ route('client.post.show', $post->id) }}">
                                                    @if ($post->image)
                                                        <img class="img-responsive" src="{{ \Storage::url($post->image) }}"
                                                            alt="BLOG {{ $post->title }}"
                                                            style="width: 50px; height: 70px;">
                                                    @else
                                                        <p>Không có ảnh</p>
                                                    @endif
                                                </a>
                                            </div>
                                            <h4>
                                                <a
                                                    href="{{ route('client.post.show', $post->id) }}">{{ $post->title }}</a>
                                            </h4>
                                            <p>Lượt xem: {{ $post->views }}</p>
                                            <p>Ngày xuất bản: {{ $post->created_at->format('d/m/Y') }}</p>
                                        </article>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <!-- Hiển thị phần bình luận -->
                        <div class="post-block post-comments clearfix">
                            {{-- <h3>{{ $post->comments->count() }} Comments</h3> --}}
                            <h3>{{ $comments->count() }} Comments</h3>
                            <ul class="comments">
                                @foreach ($comments as $comment)
                                    <li>
                                        <div class="comment">
                                            <div class="img-circle">
                                                <img class="avatar" width="50" alt=""
                                                    src="images/content/blog/avatar.png">
                                            </div>
                                            <div class="comment-block">
                                                <span class="comment-by"><strong>{{ $comment->user->name }}</strong></span>
                                                <span class="date"><small><i class="fa fa-clock-o"></i>
                                                        {{ $comment->created_at->diffForHumans() }}</small></span>
                                                <p>{{ $comment->content }}</p>

                                                <!-- Nút xóa bình luận -->
                                                @if (Auth::check() && Auth::id() === $comment->user_id)
                                                    <form
                                                        action="{{ route('client.comments.destroy', ['post' => $post_show->id, 'comment' => $comment->id]) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                                    </form>
                                                @endif

                                                <!-- Nút "Reply" -->
                                                <a href="javascript:void(0)" class="reply-link"
                                                    data-comment-id="{{ $comment->id }}">
                                                    <small><i class="fa fa-reply"></i> Reply</small>
                                                </a>

                                                <form action="{{ route('client.comments.store', $post_show->id) }}"
                                                    method="POST" style="margin-top:10px; display:none;" class="reply-form"
                                                    id="reply-form-{{ $comment->id }}">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <textarea name="content" class="form-control" rows="3" required></textarea>
                                                    <button type="submit" class="btn btn-primary btn-sm"
                                                        style="margin-top: 5px;">Gửi trả lời</button>
                                                </form>

                                                <!-- Hiển thị các bình luận trả lời -->
                                                @if ($comment->replies->count())
                                                    <ul class="replies">
                                                        @foreach ($comment->replies as $reply)
                                                            <li>
                                                                <div class="comment">
                                                                    <div class="img-circle">
                                                                        <img class="avatar" width="50" alt=""
                                                                            src="images/content/blog/avatar.png">
                                                                    </div>
                                                                    <div class="comment-block">
                                                                        <span
                                                                            class="comment-by"><strong>{{ $reply->user->name }}</strong></span>
                                                                        <span class="date"><small><i
                                                                                    class="fa fa-clock-o"></i>
                                                                                {{ $reply->created_at->diffForHumans() }}</small></span>
                                                                        <p>{{ $reply->content }}</p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <!-- Nút xóa bình luận -->
                                                            @if (Auth::check() && Auth::id() === $comment->user_id)
                                                                <form
                                                                    action="{{ route('client.comments.destroy', ['post' => $post_show->id, 'comment' => $comment->id]) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Xóa</button>
                                                                </form>
                                                            @endif
                                                            <!-- Nút "Reply" -->
                                                            <a href="javascript:void(0)" class="reply-link"
                                                                data-comment-id="{{ $reply->id }}">
                                                                <small><i class="fa fa-reply"></i> Reply</small>
                                                            </a>
                                                            <form action="{{ route('client.comments.store', $post_show->id) }}"
                                                                method="POST" style="margin-top:10px; display:none;" class="reply-form"
                                                                id="reply-form-{{ $reply->id }}">
                                                                @csrf
                                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                                <textarea name="content" class="form-control" rows="3" required></textarea>
                                                                <button type="submit" class="btn btn-primary btn-sm"
                                                                    style="margin-top: 5px;">Gửi trả lời</button>
                                                            </form>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        @if (Auth::check())
                            <div class="post-block post-leave-comment">
                                <h3>Leave a comment</h3>
                                <p><small></small></p>
                                <form action="{{ route('client.comments.store', $post_show->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label>Your name *</label>
                                                <input type="text" value="{{ Auth::user()->name }}" maxlength="100"
                                                    class="form-control" name="name" id="name" readonly>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>Your email address *</label>
                                                <input type="email" value="{{ Auth::user()->email }}" maxlength="100"
                                                    class="form-control" name="email" id="email" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Comment *</label>
                                                <textarea maxlength="5000" rows="10" class="form-control" name="content" id="comment" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="Post Comment" class="btn btn-sm"
                                                data-loading-text="Loading...">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="post-block post-leave-comment">
                                <h3>You must be logged in to leave a comment</h3>
                                <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận.</p>
                            </div>
                        @endif

                    </article>

                </div>
            </div>
            {{-- <div class="col-md-3">
                <aside class="sidebar">
                    <aside class="block tabs">
                        <ul class="nav nav-tabs second-tabs">
                            <li class="active"><a href="#popularPosts" data-toggle="tab"><i class="icon icon-star"></i>
                                    Phổ biến</a></li>
                            <li><a href="#latestPosts" data-toggle="tab">Mới nhất</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="popularPosts">
                                <ul class="list-unstyled simple-post-list">
                                    <li>
                                        <div class="post-image">
                                            <a href="blog-single.html"><img class="img-responsive"
                                                    src="images/content/blog/demo-thumb-7.jpg" alt="Blog"></a>
                                        </div>
                                        <div class="post-info">
                                            <a href="blog-single.html">New York Fashion Week A/W 2014: women swear</a>
                                            <div class="post-meta">
                                                <i class="fa fa-eye"></i> 113 views
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane" id="latestPosts">
                                <ul class="list-unstyled simple-post-list">
                                    <li>
                                        <div class="post-image">
                                            <a href="blog-single.html"><img class="img-responsive"
                                                    src="images/content/blog/demo-thumb-3.jpg" alt="Blog"></a>
                                        </div>
                                        <div class="post-info">
                                            <a href="blog-single.html">New York Fashion Week A/W 2014: womenswear
                                                collections</a>
                                            <div class="post-meta">
                                                <i class="fa fa-eye"></i> 113 views
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </aside>
            </div> --}}

            <div class="col-md-3">
                <aside class="sidebar">
                    <aside class="block tabs">
                        <ul class="nav nav-tabs second-tabs">
                            <li class="active">
                                <a href="#mostCommentedPosts" data-toggle="tab"><i class="icon icon-comments"></i> Nhiều
                                    bình luận</a>
                            </li>
                            <li>
                                <a href="#popularPosts" data-toggle="tab"><i class="icon icon-star"></i> Phổ biến</a>
                            </li>
                            {{-- <li>
                                <a href="#latestPosts" data-toggle="tab">Mới nhất</a>
                            </li> --}}
                        </ul>
                        <div class="tab-content">
                            <!-- Tab bài viết có nhiều bình luận nhất -->
                            <div class="tab-pane active" id="mostCommentedPosts">
                                <ul class="list-unstyled simple-post-list">
                                    @foreach ($mostCommentedPosts as $post)
                                        <li>
                                            <div class="post-image">
                                                <a href="{{ route('client.post.show', $post->id) }}">
                                                    <img class="img-responsive" src="{{ \Storage::url($post->image) }}"
                                                        alt="{{ $post->title }}">
                                                </a>
                                            </div>
                                            <div class="post-info">
                                                <a
                                                    href="{{ route('client.post.show', $post->id) }}">{{ $post->title }}</a>
                                                <div class="post-meta">
                                                    <i class="fa fa-comments"></i> {{ $post->comments_count }} bình luận
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Tab bài viết phổ biến nhất -->
                            <div class="tab-pane" id="popularPosts">
                                <ul class="list-unstyled simple-post-list">
                                    @foreach ($mostViewedPosts as $post)
                                        <li>
                                            <div class="post-image">
                                                <a href="{{ route('client.post.show', $post->id) }}">
                                                    <img class="img-responsive" src="{{ \Storage::url($post->image) }}"
                                                        alt="{{ $post->title }}">
                                                </a>
                                            </div>
                                            <div class="post-info">
                                                <a
                                                    href="{{ route('client.post.show', $post->id) }}">{{ $post->title }}</a>
                                                <div class="post-meta">
                                                    <i class="fa fa-eye"></i> {{ $post->views }} lượt xem
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Tab bài viết mới nhất -->
                            {{-- <div class="tab-pane" id="latestPosts">
                                <ul class="list-unstyled simple-post-list">
                                    @foreach ($recentPosts as $post)
                                    <li>
                                        <div class="post-image">
                                            <a href="{{ route('client.post.show', $post->id) }}">
                                                <img class="img-responsive" src="{{ asset('path-to-your-thumbnail/' . $post->image) }}" alt="{{ $post->title }}">
                                            </a>
                                        </div>
                                        <div class="post-info">
                                            <a href="{{ route('client.post.show', $post->id) }}">{{ $post->title }}</a>
                                            <div class="post-meta">
                                                <i class="fa fa-eye"></i> {{ $post->views }} lượt xem
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div> --}}
                        </div>
                    </aside>
                </aside>
            </div>

        </div>
    </div>
    <script>
        // Lắng nghe sự kiện click vào nút "Reply"
        document.querySelectorAll('.reply-link').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Lấy ID của bình luận được trả lời
                var commentId = this.getAttribute('data-comment-id');

                // Tìm form trả lời tương ứng và hiện form
                var replyForm = document.getElementById('reply-form-' + commentId);
                if (replyForm.style.display === "none" || replyForm.style.display === "") {
                    replyForm.style.display = "block"; // Hiện form
                } else {
                    replyForm.style.display = "none"; // Ẩn form nếu đã hiện
                }
            });
        });
    </script>
@endsection
