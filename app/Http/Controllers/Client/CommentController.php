<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Lưu bình luận
    public function store(Request $request, $postId)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            Comment::create([
                'post_id' => $postId,
                'user_id' => Auth::id(),
                'content' => $request->content,
            ]);
            return redirect()->route('client.post_show', $postId)->with('success', 'Bình luận thành công!');
        }

        return redirect()->route('client.post_show', $postId)->with('error', 'Bạn cần đăng nhập để bình luận!');
    }
}
