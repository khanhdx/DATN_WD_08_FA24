<?php

namespace App\Services\Product;


use App\Models\ProductVariant;
use App\Repositories\VariantRepositopy;
use Illuminate\Support\Facades\Validator;

class VariantService implements IVariantService {
    protected $variant;

    public function __construct(VariantRepositopy $variantRepositopy, )
    {
        $this->variant = $variantRepositopy;
    }

    public function getAll()
    {
        $variants = $this->variant->getAll();

        // dd($variants);

        return $variants;
    }

    public function getOneById($id)
    {
        $variant = $this->variant->getOneById($id);

        return $variant;
    }

    public function insert($data)
    {
        try {

            
            $variantInput = $data;
        
            //Kiểm tra sp biến nào có trùng không ?

            //Insert lên DB
            $variant = $this->variant->insert($variantInput);

        
          return redirect()->route('admin.products.variants.index')->with('success', 'Thêm biến thể thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errors', $th->getMessage());
        }
    }

    public function update($data, $id)
    {

        try {
            
            //update lên DB
            $variantInput = $data;
            // dd($productInput);

            $variant = $this->variant->updateById($variantInput, $id);

             return redirect()->route('admin.products.variants.index')->with('success', 'Cập nhật biến thể thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errors', $th->getMessage());
        }
    }

    public function delete($data) {
        
    }

    
}