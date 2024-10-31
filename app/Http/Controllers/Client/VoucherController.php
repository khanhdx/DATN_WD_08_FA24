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
            $data['check'] = waresList::query()->where('vouchers_ware_id', '=', Auth::user()->vouchers_ware->id)->get();
            $data['miss'] = $data['voucher_new']->whereNotIn('id', $data['check']->pluck('voucher_id'));
        }
        foreach ($data['voucher_new'] as $item) {
            if(waresList::query()->where('vouchers_ware_id', '=', Auth::user()->vouchers_ware->id)->where('voucher_id','=',$item->id)->first()) {
                $item->check = true;
            }
            else {
                $item->check = false;
            }
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
                if(waresList::query()->where('vouchers_ware_id', '=', Auth::user()->vouchers_ware->id)->where('voucher_id','=',$data['voucher']->id)->first()) {
                    $data['voucher']->check = true;
                }
                else {
                    $data['voucher']->check = false;
                }
            }
            else {
                $data['voucher']->check = false;
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
        $wari = Auth::user()->vouchers_ware;
        $param = [
            'voucher_id'=>$request->input('voucher_id'),
            'status'=> 'Chưa sử dụng',
        ];
        if($wari==null) {
            $data = [
                'user_id' => Auth::user()->id,
            ];
            $vouchersWare = vouchersWare::query()->create($data);
            $vouchersWare->wares_list()->create($param);
        }
        else {
            $user = User::query()->find(Auth::user()->id);
            $param = [
                'voucher_id'=>$request->input('voucher_id'),
                'vouchers_ware_id'=>$user->vouchers_ware->id,
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
}
