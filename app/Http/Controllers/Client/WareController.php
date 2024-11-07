<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\waresList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WareController extends Controller
{
    //
    public function wareList() {
        if(Auth::user()) {
            $data['wares'] = waresList::query()->where('vouchers_ware_id','=',Auth::user()->vouchers_ware->id)->get();
            return view('client.vouchers.ware',$data);
        }
        else {
            abort(404);
        }
    }
}
