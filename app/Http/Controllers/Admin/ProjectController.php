<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    //
    public function index() {
        return view('admin.project.index');
    }
    public function edit(String $id) {
        return view('admin.project.edit');
    }
    public function update(Request $request , String $id) {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$id.',id',
            'phone_number'=>'numeric',
        ],[
            'name.required' => 'Tên không thể bỏ trống',
            'name.string' => 'Tên không hợp lệ',
            'name.max' => 'Tên quá dài',
            'email.required' => 'Email không thể bỏ trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'phone_number.numeric' => 'Số điện thoại không hợp lệ',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else {
            $user = User::findOrFail(Auth::user()->id);
            $data = [
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'phone_number'=>$request->input('phone_number'),
            ];
            if ($request->file('user_image')) {
                $data['user_image'] = $request->file('user_image')->store('uploads/accounts', 'public');
                if (Auth::user()->user_image) {
                    Storage::disk('public')->delete(Auth::user()->user_image);
                }
            }
            $user->update($data);
            return response()->json([
                'status'=>200,
                'message'=>'Cập nhật thành công!'
            ]);
        }
    }
}
