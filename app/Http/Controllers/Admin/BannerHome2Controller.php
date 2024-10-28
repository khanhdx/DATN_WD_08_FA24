<?php

namespace App\Http\Controllers\Admin;

use App\Models\BannerHome2;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerHome2Controller extends Controller
{
    public function index()
    {
        $title = "Danh mục Slider";
        $listBanner = BannerHome2::all();
        return view("admin.slider.banner2.index", compact("title", "listBanner"));
        
    }
    
    public function create()
    {
        $title = "Thêm mới banner";
        return view('admin.slider.banner2.create' , compact('title'));
    }
    
    public function store(Request $request)
{
    // Lấy dữ liệu title, image và status từ request
    $titles = $request->input('title');
    $images = $request->file('image');
    $statuses = $request->input('status');

    if ($titles && $images && $statuses && count($titles) == count($images) && count($titles) == count($statuses)) {
        foreach ($titles as $index => $title) {
            $banner = new BannerHome2();
            $banner->title = $title;
            $banner->status = ($statuses[$index] == 'active') ? 1 : 0;

            if ($images[$index]->isValid()) {
                $imagePath = $images[$index]->store('images', 'public');
                $banner->image = $imagePath;
            } else {
                return redirect()->route('admin.slider.banner2.index')->with('error', 'File ảnh không hợp lệ cho một hoặc nhiều banner');
            }

            $banner->save();
        }

        return redirect()->route('admin.slider.banner2.index')->with('success', 'Thêm mới banner thành công');
    } else {
        return redirect()->route('admin.slider.banner2.index')->with('error', 'Dữ liệu banner không hợp lệ');
    }
}
    
    
    public function edit(string $id)
    {
        $title = "Chỉnh sửa mục sản phẩm";
        $banner = BannerHome2::findOrFail($id);
        return view("admin.slider.banner2.edit", compact("title", "banner"));
    }
    
    
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'required|boolean',
    ]);

    $banner = BannerHome2::findOrFail($id);
    $banner->title = $request->input('title');
    $banner->status = $request->input('status');

    if ($request->hasFile('image')) {
        if ($request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('images', 'public');
            $banner->image = $imagePath;
        } else {
            return redirect()->route('admin.slider.banner2.edit', $id)->with('error', 'File ảnh không hợp lệ');
        }
    }

    $banner->save();

    return redirect()->route('admin.slider.banner2.index')->with('success', 'Cập nhật banner thành công');
}
    
    public function destroy(string $id)
    {
        $banner = BannerHome2::findOrFail($id);
        $banner->delete();
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }
        return redirect()->route('admin.slider.banner2.index')->with('success','Bạn đã xóa thành công');
    }
}
