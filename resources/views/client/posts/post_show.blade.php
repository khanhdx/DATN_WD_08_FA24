@extends('client.layouts.master')

@section('content')

    <!-- Begin Main -->
    <div role="main" class="main">

        <!-- Begin page top -->
        <section class="page-top-md">
            <div class="container">
                <div class="page-top-in">
                    <h2><span>Blog single</span></h2>
                </div>
            </div>
        </section>
        <!-- End page top -->

        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="blog-posts single-post">
                        <article class="post post-large blog-single-post">
                            <h3>{{ $post_show->title }}</h3>
                            <div class="post-meta">
                                <span>By <a href="#">{{ $post_show->author }}</a> in <a href="#">Blog</a></span>
                                <span><i class="fa fa-clock-o"></i> {{ $post_show->publish_date }} </span>
                                <span><i class="fa fa-comment-o"></i> <a href="#">212 Comments</a></span>
                            </div>
                            <div class="post-image single">
                                <img class="img-responsive" src="images/content/blog/demo-3.jpg" alt="Blog">
                                @if ($post_show->image)
                                    <img class="img-responsive" src="{{ asset('storage/' . $post_show->image) }}"
                                        alt="Blog {{ $post_show->title }}">
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
                                    <div class="col-xs-4">
                                        <article class="post">
                                            @foreach ($recentPosts as $post)
                                                
                                                <div class="post-image">
                                                    <a href="{{ route('client.post_show', $post->id) }}">
                                                        @if ($post->image)
                                                            <img class="img-responsive" src="{{ $post->image }}"
                                                                alt="Blog {{ $post->title }}">
                                                        @else
                                                            <p>Không có ảnh</p>
                                                        @endif
                                                    </a>
                                                </div>
                                                <h4>
                                                    <a href="{{ route('client.post_show', $post->id) }}">{{ $post->title }}</a>
                                                </h4>
                                                <p>Lượt xem: {{ $post->views }}</p>
                                                <p>Ngày xuất bản: {{ $post->created_at->format('d/m/Y') }}</p>
                                            @endforeach

                                        </article>
                                    </div>
                                    {{-- <div class="col-xs-4">
                                        <article class="post">
                                            <div class="post-image">
                                                <a href="blog-single.html"><img class="img-responsive"
                                                        src="images/content/blog/demo-6.jpg" alt="Blog"></a>
                                            </div>
                                            <h4><a href="blog-single.html">Rendez-Vous: Roger Vivier's demi-couture
                                                    collection </a></h4>
                                        </article>
                                    </div>
                                    <div class="col-xs-4">
                                        <article class="post">
                                            <div class="post-image">
                                                <a href="blog-single.html"><img class="img-responsive"
                                                        src="images/content/blog/demo-5.jpg" alt="Blog"></a>
                                            </div>
                                            <h4><a href="blog-single.html">Haute happenings: Tales from the Paris Couture
                                                    Spring/Summer 2014 season</a></h4>
                                        </article>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="post-block post-comments clearfix">
                                <h3>3 Comments</h3>
                                <ul class="comments">
                                    <li>
                                        <div class="comment">
                                            <div class="img-circle"> <img class="avatar" width="50" alt=""
                                                    src="images/content/blog/avatar.png"> </div>
                                            <div class="comment-block">
                                                <span class="comment-by"> <strong>Frank Reman</strong></span>
                                                <span class="date"><small><i class="fa fa-clock-o"></i> January 12,
                                                        2013</small></span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra
                                                    euismod odio, gravida pellentesque urna varius vitae, gravida
                                                    pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.</p>
                                                <a href="#"><small><i class="fa fa-reply"></i> Reply</small></a>
                                            </div>
                                        </div>
                                        <ul class="comments reply">
                                            <li>
                                                <div class="comment">
                                                    <div class="img-circle"> <img class="avatar" width="50"
                                                            alt="" src="images/content/blog/avatar.png"> </div>
                                                    <div class="comment-block">
                                                        <span class="comment-by"> <strong>Frank Reman</strong></span>
                                                        <span class="date"><small><i class="fa fa-clock-o"></i> July 11,
                                                                2014</small></span>
                                                        <p>Nam viverra euismod odio, gravida pellentesque urna varius vitae,
                                                            gravida pellentesque urna varius vitae. Lorem ipsum dolor sit
                                                            amet, consectetur adipiscing elit.</p>
                                                        <a href="#"><small><i class="fa fa-reply"></i>
                                                                Reply</small></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="comment">
                                                    <div class="img-circle"> <img class="avatar" width="50"
                                                            alt="" src="images/content/blog/avatar.png"> </div>
                                                    <div class="comment-block">
                                                        <span class="comment-by"> <strong>Frank Reman</strong></span>
                                                        <span class="date"><small><i class="fa fa-clock-o"></i> July 11,
                                                                2014</small></span>
                                                        <p>Gravida pellentesque urna varius vitae. Lorem ipsum dolor sit
                                                            amet, consectetur adipiscing elit.</p>
                                                        <a href="#"><small><i class="fa fa-reply"></i>
                                                                Reply</small></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="comment">
                                            <div class="img-circle"> <img class="avatar" width="50" alt=""
                                                    src="images/content/blog/avatar.png"> </div>
                                            <div class="comment-block">
                                                <span class="comment-by"> <strong>Frank Reman</strong></span>
                                                <span class="date"><small><i class="fa fa-clock-o"></i> July 11,
                                                        2014</small></span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra
                                                    euismod odio, gravida pellentesque urna varius vitae, gravida
                                                    pellentesque urna varius vitae</p>
                                                <a href="#"><small><i class="fa fa-reply"></i> Reply</small></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment">
                                            <div class="img-circle"> <img class="avatar" width="50" alt=""
                                                    src="images/content/blog/avatar.png"> </div>
                                            <div class="comment-block">
                                                <span class="comment-by"> <strong>Frank Reman</strong></span>
                                                <span class="date"><small><i class="fa fa-clock-o"></i> July 11,
                                                        2014</small></span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                <a href="#"><small><i class="fa fa-reply"></i> Reply</small></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="post-block post-leave-comment">
                                <h3>Leave a comment</h3>
                                <p><small>Make sure you enter the (*) required information where indicated. HTML code is not
                                        allowed.</small></p>
                                <form action="#" type="post">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label>Your name *</label>
                                                <input type="text" value="" maxlength="100"
                                                    class="form-control" name="name" id="name">
                                            </div>
                                            <div class="col-xs-6">
                                                <label>Your email address *</label>
                                                <input type="email" value="" maxlength="100"
                                                    class="form-control" name="email" id="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Website URL</label>
                                                <input type="text" value="" maxlength="100"
                                                    class="form-control" name="url" id="url">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Comment *</label>
                                                <textarea maxlength="5000" rows="10" class="form-control" name="comment" id="comment"></textarea>
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
                        </article>

                    </div>
                </div>
                <div class="col-md-3">
                    <aside class="sidebar">
                        {{-- <aside class="block">
                            <form class="form-inline form-search form-search2" class="form-inline" role="form">
                                <div class="form-group">
                                    <label class="sr-only" for="textsearch2">Enter text search</label>
                                    <input type="text" class="form-control input-lg" id="textsearch2"
                                        placeholder="Enter text search">
                                </div>
                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                            </form>
                        </aside> --}}
                        {{-- <aside class="block blk-ads">
                            <h4>Ads</h4>
                            <img class="img-responsive" src="images/content/blog/side-ad.png" alt="Blog">
                        </aside> --}}
                        <aside class="block tabs">
                            <ul class="nav nav-tabs second-tabs">
                                <li class="active"><a href="#popularPosts" data-toggle="tab"><i
                                            class="icon icon-star"></i> Phổ biến</a></li>
                                {{-- <li><a href="#latestPosts" data-toggle="tab">Mới nhất</a></li> --}}
                                <li><a href="#latestComments" data-toggle="tab">Bình luận</a></li>
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
                                        {{-- <li>
                                            <div class="post-image">
                                                <a href="blog-single.html"><img class="img-responsive"
                                                        src="images/content/blog/demo-thumb-6.jpg" alt="Blog"></a>
                                            </div>
                                            <div class="post-info">
                                                <a href="blog-single.html">Retail Directory 2014: the finest new openings
                                                    across</a>
                                                <div class="post-meta">
                                                    <i class="fa fa-eye"></i> 113 views
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-image">
                                                <a href="blog-single.html"><img class="img-responsive"
                                                        src="images/content/blog/demo-thumb-5.jpg" alt="Blog"></a>
                                            </div>
                                            <div class="post-info">
                                                <a href="blog-single.html">Paris Fashion Week: the stellar finale to the
                                                    A/W</a>
                                                <div class="post-meta">
                                                    <i class="fa fa-eye"></i> 113 views
                                                </div>
                                            </div>
                                        </li>
                                        <li>--}}
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
                                        {{-- <li>
                                            <div class="post-image">
                                                <a href="blog-single.html"><img class="img-responsive"
                                                        src="images/content/blog/demo-thumb-4.jpg" alt="Blog"></a>
                                            </div>
                                            <div class="post-info">
                                                <a href="blog-single.html">Retail Directory 2014: the finest new openings
                                                    across the globe</a>
                                                <div class="post-meta">
                                                    <i class="fa fa-eye"></i> 113 views
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-image">
                                                <a href="blog-single.html"><img class="img-responsive"
                                                        src="images/content/blog/demo-thumb-5.jpg" alt="Blog"></a>
                                            </div>
                                            <div class="post-info">
                                                <a href="blog-single.html">Paris Fashion Week: the stellar finale to the
                                                    A/W 2014 season</a>
                                                <div class="post-meta">
                                                    <i class="fa fa-eye"></i> 113 views
                                                </div>
                                            </div>
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="tab-pane" id="latestComments">
                                    <ul class="simple-post-list">
                                        <li>
                                            <div class="post-info">
                                                <a href="blog-single.html">New York Fashion Week A/W 2014: womenswear
                                                    collections</a>
                                                <div class="post-meta">
                                                    <i class="fa fa-eye"></i> 113 views
                                                </div>
                                            </div>
                                        </li>
                                        {{-- <li>
                                            <div class="post-info">
                                                <a href="blog-single.html">Retail Directory 2014: the finest new openings
                                                    across the globe</a>
                                                <div class="post-meta">
                                                    <i class="fa fa-eye"></i> 113 views
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-info">
                                                <a href="blog-single.html">Paris Fashion Week: the stellar finale to the
                                                    A/W 2014 season</a>
                                                <div class="post-meta">
                                                    <i class="fa fa-eye"></i> 113 views
                                                </div>
                                            </div>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </aside>
                </div>
            </div>
        </div>

    </div>
    <!-- End Main -->
@endsection
