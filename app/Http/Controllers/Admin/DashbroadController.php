<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Statistical\StatisticalService;
use Illuminate\Http\Request;

class DashbroadController extends Controller
{
    protected $statisical;

    public function __construct(StatisticalService $statisticalService)
    {
        $this->statisical = $statisticalService;
    }


    public function index()
    {
        $revenue = $this->statisical->getRevenueByDay();
        // dd($revenue);

        return view('admin.dashbroad');
    }
}
