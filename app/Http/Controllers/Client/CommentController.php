<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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
            'parent_id' => 'nullable|exists:comments,id' // Kiểm tra nếu parent_id có tồn tại trong bảng comments
        ]);

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            Comment::create([
                'post_id' => $postId,
                'user_id' => Auth::id(),
                'content' => $request->content,
                'parent_id' => $request->input('parent_id') // Lưu parent_id nếu là trả lời
            ]);
            return redirect()->route('client.post.show', $postId)->with('success', 'Bình luận thành công!');
        }

        return redirect()->route('client.post.show', $postId)->with('error', 'Bạn cần đăng nhập để bình luận!');
    }
    
    // Hàm xóa bình luận
    public function destroy($postId, Comment $comment)
    {
        // Kiểm tra xem người dùng có phải là chủ của bình luận hay không
        if (Auth::check() && Auth::user()->id === $comment->user_id) {
            // Xóa bình luận
            $comment->delete();

            return redirect()->route('client.post.show', $postId)->with('success', 'Bình luận đã được xóa thành công.');
        }

        return redirect()->route('client.post.show', $postId)->with('error', 'Bạn không có quyền xóa bình luận này.');
    }
}
