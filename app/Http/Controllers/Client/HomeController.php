<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $data = Product::with(['category'])->latest('id')->paginate(5);
// dd($data);
        return view('client.' . __FUNCTION__, compact('data'));
    }
}
