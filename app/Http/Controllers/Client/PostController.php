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

    public function show(Post $post_show)
    {
        // Lấy 5 bài viết gần đây nhất
        $recentPosts = Post::orderBy('created_at', 'desc')->take(3)->get();

        // Lấy 5 bài viết được xem nhiều nhất
        $mostViewedPosts = Post::orderBy('views', 'desc')->take(7)->get();

        // Lấy 5 bài viết có nhiều bình luận nhất
        $mostCommentedPosts = Post::withCount('comments') // Đếm số lượng bình luận
        ->orderBy('comments_count', 'desc') // Sắp xếp theo số lượng bình luận giảm dần
        ->take(7) // Lấy 5 bài viết
        ->get();

        // Lấy bình luận của bài viết, bao gồm cả bình luận trả lời
        // $comments = $post_show->comments()->with('user')->get();
        $comments = $post_show->comments()->whereNull('parent_id')->with('replies.user', 'user')->get();


        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'post_show',
            'recentPosts',
            'mostViewedPosts',
            'comments', // Thêm bình luận vào view
            'mostCommentedPosts'
        ));
    }
}
