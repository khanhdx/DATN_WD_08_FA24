<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Hiển thị trang cá nhân
    public function index()
    {
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
        return view('client.profile.index', compact('user'));
    }

    // Hiển thị trang chỉnh sửa thông tin cá nhân
    public function edit()
    {
        $user = Auth::user();
        return view('client.profile.edit', compact('user'));
    }

    // Cập nhật thông tin cá nhân
    public function update(UpdateProfileRequest $request)
{
    $user = $request->user(); // Lấy thông tin người dùng hiện tại

    // Cập nhật thông tin người dùng
    $user->name = $request->name;
    $user->phone_number = $request->phone_number;

    // Nếu có hình ảnh, lưu trữ và cập nhật đường dẫn
    if ($request->hasFile('user_image')) {
        // Xóa hình ảnh cũ nếu có (nếu cần)
        if ($user->user_image) {
            Storage::disk('public')->delete($user->user_image);
        }
        $path = $request->file('user_image')->store('user_images', 'public');
        $user->user_image = $path;
    }

    $user->save(); // Lưu thông tin vào cơ sở dữ liệu

    return redirect()->route('profile.index')->with('success', 'Cập nhật thông tin thành công.');
}

    // Xóa tài khoản người dùng (nếu cần thiết)
    public function destroy()
    {
    }
}
