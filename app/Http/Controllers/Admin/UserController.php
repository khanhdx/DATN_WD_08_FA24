<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Mail\UserMailConfirm;
use App\Models\Locations;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;
use Str;
use Vtiful\Kernel\Excel;

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
        $data['accounts'] = User::query()->paginate(10);
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
    public function store(Request $request)
    {
        //Lấy dữ liệu từ form
        if($request->isMethod('POST')) {
            $user = $request->input('user');
            $user['password'] = Str::random(8);
            if($request->hasFile('user_image')) {
                $user['user_image'] = $request->file('user_image')->store('uploads/accounts', 'public');
            }else {
                $user['user_image'] = null;
            }
            $user_new = User::query()->create($user);
            $locations = $request->input('location');
            $status_location = $request->input('status');
            foreach ($locations as $key => $location) {
                $location['user_id'] = $user_new->id;
                if($status_location == $key) {
                    $location['status'] = "Mặc định";
                }else {
                    $location['status'] = "Phụ";
                }
                Locations::query()->create($location);
            }
            Mail::to($user['email'])->send(new UserMailConfirm($user_new));
            return redirect()->route('user.index')->with('success', 'Thàn công');
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
