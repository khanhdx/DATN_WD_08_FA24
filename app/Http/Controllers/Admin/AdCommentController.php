<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdCommentController extends Controller
{
    // Hiển thị danh sách bình luận (kèm trạng thái)
    public function index()
    {
        $comments = Comment::with('post', 'user')
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Hiển thị 10 bình luận mỗi trang

        return view('admin.comments.index', compact('comments'));
    }

    // Phê duyệt bình luận
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $status = $request->input('status', 'pending'); // Mặc định là 'pending'

        if (in_array($status, ['approved', 'hidden', 'pending'])) {
            $comment->status = $status;
            $comment->save();

            return redirect()->back()->with('success', 'Trạng thái bình luận đã được cập nhật.');
        }

        return redirect()->back()->with('error', 'Trạng thái không hợp lệ.');
    }

    // Ẩn hoặc xóa bình luận
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (request()->has('action') && request('action') === 'hide') {
            $comment->status = 'hidden';
            $comment->save();

            return redirect()->route('admin.comments.index')->with('success', 'Bình luận đã được ẩn.');
        }

        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Bình luận đã được xóa.');
    }
}