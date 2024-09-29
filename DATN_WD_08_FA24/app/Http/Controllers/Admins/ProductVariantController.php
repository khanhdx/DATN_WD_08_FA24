<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Services\Product\IVariantService;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    protected $variantService;

    public function __construct(IVariantService $iVariantService)
    {
        $this->variantService = $iVariantService;
    }


    public function index()
    {
        return $this->variantService->getAll();
    }

    
    public function store(Request $request)
    {
        return $this->variantService->insert($request->all());
    }   

    public function update(Request $request, $id){

        return $this->variantService->update($request->all(), $id);
    }
}
