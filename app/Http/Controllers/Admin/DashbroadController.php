<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderPlaced;
use App\Http\Controllers\Controller;
use App\Services\Statistical\StatisticalService;
use Illuminate\Http\Request;

class DashbroadController extends Controller
{

    public function index()
    {
       
        return view('admin.dashbroad');
    }
}
