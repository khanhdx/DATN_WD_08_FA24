<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\CreateLocationRequest;
use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLocationRequest $request)
    {
        //
        if($request->isMethod('POST')) {
            $data = $request->only('user_id', 'location_name', 'user_name', 'phone_number');
            $data['location_detail'] = $request->input('city')."-".$request->input('district')."-".$request->input("ward")."-".$request->input("detail");
            if(!empty($request->input('status'))) {
                $data['status'] = $request->input('status');
                $locations = Locations::query()->where('user_id','=',$data['user_id'])->get();
                foreach ($locations as $uplocation) {
                    $uplocation->update(['status'=>'Phụ']);
                }
            }
            else {
                $data['status'] = "Phụ";
            }
            Locations::query()->create($data);
            return redirect()->route('admin.user.edit',$data['user_id'])->with('success', 'Thêm mới thành công!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        if($request->isMethod('PUT')) {
            $location = Locations::query()->findOrFail($id);
            $validate = Validator::make($request->all(), [
                "location_name"=>"required|max:255",
                "user_name"=>"required|max:255",
                "phone_number"=>"required|max:11",
                "city_edit"=>"required",
                "district_edit"=>"required",
                "ward_edit"=>"required",
                "detail_edit"=>"required",

            ], [
                "location_name.required"=>"Tên địa chỉ trống!",
                "location_name.max"=>"Tên quá dài!",
                "user_name.required"=>"Người nhận trống!",
                "user_name.max"=>"Tên người nhận quá dài!",
                "phone_number.required"=>"Số điện thoại trống!",
                "phone_number.max"=>"Số quá dài!",
                "city_edit.required"=>"Không bỏ trống!",
                "district_edit.required"=>"Không bỏ trống!",
                "ward_edit.required"=>"Không bỏ trống!",
                "detail_edit.required"=>"Không bỏ trống!",
            ]);
            $data = $request->only('location_name', 'user_name', 'phone_number');
            $data['location_detail'] = $request->input('city_edit')."-".$request->input('district_edit')."-".$request->input("ward_edit")."-".$request->input("detail_edit");
            if(!empty($request->input('status'))) {
                $data['status'] = $request->input('status');
                $locations = Locations::query()->where('user_id','=',$location->user_id)->get();
                foreach ($locations as $uplocation) {
                    $uplocation->update(['status'=>'Phụ']);
                }
            }
            else {
                $data['status'] = "Phụ";
            }
            $location->update($data);
            return redirect()->route('admin.user.edit', $location->user_id)->with('success','Thêm địa chỉ thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
        if($request->isMethod('DELETE')) {
            $location = Locations::query()->findOrFail($id);
            $user_id = $location->user_id;
            $location->delete();
            return redirect()->route('admin.user.edit',$user_id)->with('success', 'Xóa thành công');
        }
    }
}
