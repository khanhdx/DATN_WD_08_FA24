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
<<<<<<< HEAD
        // dd($revenue);
=======
>>>>>>> c567d0b57445db27d80d350d4f0d99b1717aa91b

        return view('admin.dashbroad');
    }
}
