<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Services\Statistical\StatisticalService;
use Illuminate\Http\Request;

class DashbroadController extends Controller
{

    public function index()
    {
        return view('admin.dashbroad');
    }
}
