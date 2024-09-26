<?php
namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Services\Size\ISizeService;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    protected $sizeService;


    public function __construct(ISizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }

    public function index()
    {
        return $this->sizeService->getAll();
    }



    // public function show($id)
    // {
    //     $size = $this->size->getOne($id);

    //     return response()->json(['data' => $size], 200);
    // }

    public function store(Request $request)
    {
      return $this->sizeService->insert($request->all());
    }


    public function update($id, Request $request)
    {
      return $this->sizeService->update($id, $request->all());
    }



    public function delete($id)
    {
        return $this->sizeService->delete($id);
    }
}
