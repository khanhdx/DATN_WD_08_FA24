<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\StoreUserRequest;
use App\Http\Requests\user\UpdateRequest;
use App\Mail\UserMailConfirm;
use App\Models\Locations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userService;
    public function __construct() {

    }
    public function index(Request $request)
    {
        //
        $fillter = $request->input('fillter');
        $data['accounts'] = User::query()->when($fillter, function($query,$fillter) {return $query->where('role','like',"%{$fillter}%");})
        ->orderBy('id','desc')
        ->paginate(10);
        return view('admin.accounts.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        return view('admin.accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //Lấy dữ liệu từ form
        if($request->isMethod('POST')) {
            $user = $request->only('name','email', 'phone_number', 'role');
            $user['password'] = Str::random(8);
            if($request->hasFile('user_image')) {
                $user['user_image'] = $request->file('user_image')->store('uploads/accounts', 'public');
            }else {
                $user['user_image'] = null;
            }
            $user_new = User::query()->create($user);
            $locations = $request->input('location');
            if(!empty($locations)) {
                $status_location = $request->input('status');
                if($status_location == null) {
                    $status_location = 0;
                }
                foreach ($locations as $key => $location) {
                    $location['user_id'] = $user_new->id;
                    if($status_location == $key) {
                        $location['status'] = "Mặc định";
                    }else {
                        $location['status'] = "Phụ";
                    }
                    if($location['location_name']!=null || $location['user_name']!=null || $location['phone_number']!=null || $location['location_detail']!=null) {
                        Locations::query()->create($location);
                    }
                }
            }
            Mail::to($user['email'])->send(new UserMailConfirm($user_new));
            return redirect()->route('admin.user.index')->with('success', 'Thàn công');
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
        $data['user'] = User::query()->findOrFail($id);
        $data['locations'] = Locations::query()->where('user_id',$id)->get();
        return view('admin.accounts.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        //
        if($request->isMethod('PUT')) {
            $user = User::query()->findOrFail($id);

            $data = $request->only('name','email','phone_number','role');
            if($request->hasFile('user_image')) {
                $data['user_image'] = $request->file('user_image')->store('uploads/accounts', 'public');
                if($user->user_image) {
                Storage::disk('public')->delete($user->user_image);
                }
            }
            else {
                $data['user_image'] = $user->user_image;
            }
            $user->update($data);
            return redirect()->route('admin.user.index')->with('success', 'Thêm mới thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
        if($request->isMethod('DELETE')) {
            $user = User::query()->findOrFail($id);
            $user->delete();
            return redirect()->route('admin.user.index')->with('success', 'Xóa thành công');
        }
    }
}
