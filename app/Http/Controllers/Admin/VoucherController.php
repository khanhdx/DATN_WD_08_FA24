<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\voucher\UpdateVoucherRequest;
use App\Models\User;
use App\Models\Voucher;
use App\Models\vouchersWare;
use App\Models\waresList;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->input('search');
        $data['vouchers'] = Voucher::query()->orderBy('id','DESC')->when($search, function($query,$search) {return $query->where('name', 'like', "%{$search}%")->orWhere('voucher_code', 'like', "%{$search}%");})->paginate(10);
        return view('admin.vouchers.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['users'] = User::query()->where('role', '=', 'Khách hàng')->get();
        return view('admin.vouchers.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Nhập vào
        if ($request->input('value') == "Cố định") {
            $request->validate(
                [
                    'name'=>'required|string|max:255',
                    'voucher_code'=>'required|string|max:255',
                    'description'=>'string|max:255',
                    'quanlity'=>'required',
                    'decreased_value'=>'required',
                    'condition'=>'required',
                    'date_start'=>'required',
                    'date_end'=>'required',
                ],
                [
                    'name.required'=>'Tên mã giảm giá không thể bỏ trống!',
                    'name.string'=>'Tên mã giảm giá không hợp lệ!',
                    'name.max'=>'Tên mã giảm giá quá dài!',
                    'voucher_code.required'=>'Mã code không thể bỏ trống!',
                    'voucher_code.string'=>'Mã code không hợp lệ!',
                    'voucher_code.max'=>'Mã code quá dài!',
                    'description.string'=>'Mô tả không hợp lệ!',
                    'description.max'=>'Mô tả quá dài!',
                    'quanlity.required'=>'Số lượng không thể bỏ trống!',
                    'decreased_value.required'=>'Giá trị giảm không thể bỏ trống!',
                    'condition.required'=>'Điều kiện không thể bỏ trống!',
                    'date_start.required'=>'Ngày bắt đầu không thể bỏ trống!',
                    'date_end.required'=>'Ngày kết thúc không thể bỏ trống!',
                ]
            );
            $data = $request->except('_token','_method');
            $data['max_value'] = $request->input('decreased_value');
        }
        else {
            $data = $request->validate(
                [
                    'name'=>'required|string|max:255',
                    'voucher_code'=>'required|string|max:255',
                    'description'=>'string|max:255',
                    'quanlity'=>'required',
                    'decreased_value'=>'required',
                    'max_value'=>'required',
                    'condition'=>'required',
                    'date_start'=>'required',
                    'date_end'=>'required',
                ],
                [
                    'name.required'=>'Tên mã giảm giá không thể bỏ trống!',
                    'name.string'=>'Tên mã giảm giá không hợp lệ!',
                    'name.max'=>'Tên mã giảm giá quá dài!',
                    'voucher_code.required'=>'Mã code không thể bỏ trống!',
                    'voucher_code.string'=>'Mã code không hợp lệ!',
                    'voucher_code.max'=>'Mã code quá dài!',
                    'description.string'=>'Mô tả không hợp lệ!',
                    'description.max'=>'Mô tả quá dài!',
                    'quanlity.required'=>'Số lượng không thể bỏ trống!',
                    'decreased_value.required'=>'Giá trị giảm không thể bỏ trống!',
                    'max_value.required'=>'Giá trị giảm tôi đa không thể bỏ trống!',
                    'condition.required'=>'Điều kiện không thể bỏ trống!',
                    'date_start.required'=>'Ngày bắt đầu không thể bỏ trống!',
                    'date_end.required'=>'Ngày kết thúc không thể bỏ trống!',
                ]
            );
            $data = $request->except('_token','_method');
        }

        if($data['date_start'] > today()) {
            $data['status'] = "Chưa diễn ra";
        }
        else if($data['date_start'] = today()){
            $data['status'] = "Đang diễn ra";
        }
        else {
            $data['status'] = "Đã ngừng";
        }
        $voucher_new = Voucher::query()->create($data);
        // Voucher cá nhân
        if ($request->input('type_code') == "Cá nhân") {
            $param = [
                'voucher_id'=>$voucher_new->id,
                'status'=> 'Chưa sử dụng',
            ];
            foreach ($request->input('users_id') as $id) {
                $user = User::query()->find($id);
                // Kiểm tra kho voucher
                $wari = vouchersWare::query()->where('user_id', '=', $id)->count();
                if($wari==0) {
                    $data = [
                        'user_id' => $id,
                    ];
                    $vouchersWare = vouchersWare::query()->create($data);
                    $vouchersWare->wares_list()->create($param);
                }
                else {
                    $ware = vouchersWare::query()->where('user_id','=', $id)->first();
                    $param = [
                        'voucher_id'=>$voucher_new->id,
                        'vouchers_ware_id'=>$ware->id,
                        'status'=> 'Chưa sử dụng',
        
                    ];
                    $lis = waresList::query()->create($param);
                }
            }
        }
        if($voucher_new) {
            return redirect()->route('admin.voucher.index')->with('success', 'Thêm mới thành công');
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
        $data['voucher'] = Voucher::query()->findOrFail($id);
        return view('admin.vouchers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherRequest $request, string $id)
    {
        //
        $voucher = Voucher::findOrFail($id);
        $data = $request->only('name','voucher_code','value','decreased_value','max_value','quanlity','condition','date_start','date_end','type_code','status','description',);
        $voucher->update($data);
        return redirect()->route('admin.voucher.index')->with('success','Sửa thành công mã giảm giá');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
        if($request->isMethod('DELETE')) {
            $voucher = Voucher::query()->findOrFail($id);
            $voucher->delete();
            return redirect()->route('admin.voucher.index')->with('success', 'Thêm thành công');
        }
    }
    public function applyVoucher(Request $request)
{
    $request->validate([
        'voucher_code' => 'required|string|max:255',
    ]);

    $voucher = Voucher::where('voucher_code', $request->voucher_code)->first(); // Sửa `code` thành `voucher_code`

    if (!$voucher) {
        return response()->json(['success' => false, 'message' => 'Mã giảm giá không hợp lệ.']);
    }

    // Kiểm tra thời hạn và trạng thái của voucher
    if ($voucher->date_start <= now() && $voucher->date_end >= now() && $voucher->status === 'Đang diễn ra') {
        $discount = $voucher->value; // Hoặc tính theo phần trăm
        return response()->json(['success' => true, 'discount' => $discount]);
    }

    return response()->json(['success' => false, 'message' => 'Mã giảm giá đã hết hạn hoặc không hợp lệ.']);
}
}
