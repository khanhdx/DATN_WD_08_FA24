<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Voucher;
use App\Models\vouchersWare;
use App\Models\waresList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['voucher_new'] = Voucher::query()->orderBy('created_at', 'desc')->where('type_code', '=','Công khai')->get();
        if(Auth::user()) {
            $data['ware'] = Auth::user()->vouchers_ware;
        }
        return view('client.vouchers.index', $data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 
        try {
            $data['voucher'] = Voucher::query()->findOrFail($id);
            if(Auth::user()) {
                $data['ware'] = vouchersWare::query()->where('user_id', '=', Auth::user()->id)->first();
            }
            return view('client.vouchers.detail', $data);
        } catch (\Throwable $th) {
            abort(404);
        }
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
        $wari = vouchersWare::query()->where('user_id', '=', Auth::user()->id)->count();
        $param = [
            'voucher_id'=>$request->input('voucher_id'),
            'status'=> 'Chưa sử dụng',
        ];
        if($wari==0) {
            $data = [
                'user_id' => Auth::user()->id,
            ];
            $vouchersWare = vouchersWare::query()->create($data);
            $vouchersWare->wares_list()->create($param);
        }
        else {
            $ware = vouchersWare::query()->where('user_id','=', Auth::user()->id)->first();
            $param = [
                'voucher_id'=>$request->input('voucher_id'),
                'vouchers_ware_id'=>$ware->id,
                'status'=> 'Chưa sử dụng',

            ];
            $lis = waresList::query()->create($param);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getVoucherData (string $id) {
            $voucher_wave = vouchersWare::query()->where('user_id', '=', $id)->first();
            $voucher = [];
            if ($voucher_wave) {
                $wave_list = $voucher_wave->wares_list->where('status', '=', 'Chưa sử dụng');
                foreach ($wave_list as $key => $wave) {
                    $voucher[$key] = $wave->voucher;
                }
            }
            return response()->json($voucher);
    }
}

