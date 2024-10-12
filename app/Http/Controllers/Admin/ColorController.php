<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Color\IColorService;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    protected $colorService;

    public function __construct(IColorService $colorService)
    {
        $this->colorService = $colorService;
    }

    public function index()
    {
            $this->colorService->getAll(); 
    }

    public function store(Request $request)
    {
        
        return $this->colorService->insert($request->all());
    }


    public function update($id, Request $request)
    {
        return $this->colorService->update($id, $request->all());

    }



    public function delete($id)
    {
        return $this->colorService->delete($id);
    }
}
