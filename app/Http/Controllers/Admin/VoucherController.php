<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\voucher\CreateVoucherRequest;
use App\Http\Requests\voucher\UpdateVoucherRequest;
use App\Models\Voucher;
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
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');
        $data['vouchers'] = Voucher::query()
        ->when($search, function($query,$search) { return $query
            ->where('name', 'like', "%{$search}%")
            ->orwhere('id', 'like', "%{$search}%");})
        ->whereBetween('date_start', [$date_start,$date_end])
        ->whereBetween('date_end', [$date_start,$date_end])
        ->paginate(10);
        return view('admin.vouchers.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateVoucherRequest $request)
    {
        //Nhập vào
        if($request->isMethod('POST')) {
            $data = $request->except('_token');
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
            if($voucher_new) {
                return redirect()->route('vouchers.index')->with('success', 'Thêm mới thành công');
            }
            else {
                return dd('Theem thaats baij');
            }
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
}
