<?php

namespace App\Http\Controllers\Client;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query(); // Khởi tạo query builder cho Post

        // Lọc theo tiêu đề
        if ($request->has('title') && !empty($request->input('title'))) {
            $title = $request->input('title');
            $query->where('title', 'like', "%{$title}%");
        }

        // Lọc theo ngày xuất bản
        if ($request->has('publish_date') && !empty($request->input('publish_date'))) {
            $publishDate = $request->input('publish_date');
            $query->whereDate('publish_date', $publishDate); // Thêm điều kiện lọc theo ngày
        }

        // Lấy danh sách bài viết sau khi áp dụng lọc
        $posts = $query->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        // Ghi log toàn bộ dữ liệu request
        Log::info('Request data: ', $request->all());
        $request->validate([
            'image' => 'image|nullable|max:1999',
            'title' => 'required',
            'content' => 'required',
            'author' => 'required',
            'publish_date' => 'nullable|date',
        ]);

        // Lưu ảnh nếu có upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        // Tạo bài viết

        try {
            Post::create([
                'image' => $imagePath,
                'title' => $request->title,
                'content' => $request->content,
                'author' => $request->author,
                'publish_date' => $request->publish_date,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating post: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Có lỗi xảy ra khi tạo bài viết.']);
        }

        return redirect()->route('posts.index')->with('success', 'Bài viết được tạo thành công.');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Xác thực dữ liệu từ request
        $request->validate([
            'image' => 'image|nullable|max:1999',
            'title' => 'required',
            'content' => 'required',
            'author' => 'required',
            'publish_date' => 'nullable|date',
        ]);

        // Xóa ảnh cũ nếu có ảnh mới
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $post->image; // Giữ nguyên ảnh cũ nếu không có ảnh mới
        }

        // Cập nhật bài viết
        $post->update([ // Sử dụng $post->update() để cập nhật
            'image' => $imagePath,
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'publish_date' => $request->publish_date,
        ]);

        return redirect()->route('posts.index')->with('success', 'Bài viết được cập nhật thành công.');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Bài viết đã bị xóa.');
    }


    public function clientIndex()
    {
        // Lấy tất cả bài viết từ cơ sở dữ liệu và phân trang (5 bài viết mỗi trang)
        $posts = Post::paginate(5); // Hiển thị 5 bài viết trên mỗi trang

        // Trả về view cho giao diện client, truyền danh sách bài viết vào
        return view('client.posts.posts', compact('posts'));
    }

    public function clientShow($id)
    {
        // Lấy bài viết theo id
        $post = Post::findOrFail($id);

        // Trả về view cho chi tiết bài viết
        return view('client.posts.posts_show', compact('post'));
    }
    
}