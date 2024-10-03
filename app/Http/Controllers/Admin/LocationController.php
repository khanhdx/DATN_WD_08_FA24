<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\CreateLocationRequest;
use App\Models\Locations;
use Illuminate\Http\Request;

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
            $data = $request->only('user_id', 'location_name', 'user_name', 'location_detail', 'phone_number');
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
            return redirect()->route('user.edit',$data['user_id'])->with('success', 'Thêm mới thành công!');
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
    public function update(CreateLocationRequest $request, string $id)
    {
        //
        if($request->isMethod('PUT')) {
            $location = Locations::query()->findOrFail($id);
            $data = $request->only('location_name', 'user_name', 'phone_number', 'location_detail');
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
            return redirect()->route('user.edit', $location->user_id);
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
            return redirect()->route('user.edit',$user_id)->with('success', 'Xóa thành công');
        }
    }
}
