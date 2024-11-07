<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\vouchersWare;
use App\Models\waresList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WareController extends Controller
{
    //
    public function wareList() {
        if(Auth::user()) {
            if(Auth::user()->vouchers_ware != null) {
                $data['wares'] = waresList::query()->where('vouchers_ware_id','=',Auth::user()->vouchers_ware->id)->get();
            }else 
            {
                $data = [
                    'user_id' => Auth::user()->id,
                ];
                $ware =  vouchersWare::query()->create($data);
                $data['wares'] = waresList::query()->where('vouchers_ware_id','=',$ware->id)->get();
            }
            return view('client.vouchers.ware',$data);
        }
        else {
            abort(404);
        }
    }
}
