<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    const PATH_VIEW = 'client.posts.';

    public function index()
    {
        $posts = Post::paginate(6);

        return view(self::PATH_VIEW . __FUNCTION__, compact('posts'));
    }

    public function show(Post $post)
    {
        // Lấy 5 bài viết gần đây nhất
        $recentPosts = Post::orderBy('created_at', 'desc')->take(3)->get();

        // Lấy 5 bài viết được xem nhiều nhất
        $mostViewedPosts = Post::orderBy('views', 'desc')->take(5)->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'post',
            'recentPosts',
            'mostViewedPosts'
        ));
    }
}
