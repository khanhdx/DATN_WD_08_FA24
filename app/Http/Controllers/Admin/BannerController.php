<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    // Danh sách banner
    public function index(Request $request)
    {
        $search = $request->input('search');
        $title = "Danh mục Slider";
        $listBanner = Banner::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->paginate(5);

        return view("admin.slider.index", compact("title", "listBanner", "search"));
    }

    // Form thêm mới banner
    public function create()
    {
        $title = "Thêm mới banner";
        return view('admin.slider.create', compact('title'));
    }

    // Lưu dữ liệu banner mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'image' => 'required|array',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|array',
            'status.*' => 'in:active,inactive',
            'type' => 'required|array',
            'type.*' => 'in:main,intro,advertisement',
        ]);

        $titles = $request->input('title');
        $images = $request->file('image');
        $statuses = $request->input('status');
        $types = $request->input('type');

        foreach ($titles as $index => $title) {
            $banner = new Banner();
            $banner->title = $title;
            $banner->status = ($statuses[$index] === 'active') ? 1 : 0;
            $banner->type = $types[$index];

            if (isset($images[$index]) && $images[$index]->isValid()) {
                $imagePath = $images[$index]->store('images', 'public');
                $banner->image = $imagePath;
            }

            $banner->save();
        }

        return redirect()->route('admin.slider.index')->with('success', 'Thêm mới banner thành công');
    }

    // Form chỉnh sửa banner
    public function edit($id)
    {
        $title = "Chỉnh sửa banner";
        $banner = Banner::findOrFail($id);
        return view("admin.slider.edit", compact("title", "banner"));
    }

    // Cập nhật banner
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            'type' => 'required|in:main,intro,advertisement',
        ]);

        $banner = Banner::findOrFail($id);
        $banner->title = $request->input('title');
        $banner->status = $request->input('status');
        $banner->type = $request->input('type');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Xóa ảnh cũ nếu có
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $banner->image = $imagePath;
        }

        $banner->save();

        return redirect()->route('admin.slider.index')->with('success', 'Cập nhật banner thành công');
    }

    // Xóa banner
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        // Xóa ảnh cũ nếu có
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.slider.index')->with('success', 'Xóa banner thành công');
    }
}
