<?php

namespace App\Services\Product;


use App\Models\ProductVariant;
use App\Repositories\VariantRepositopy;
use App\Services\Inventory\InventoryService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VariantService implements IVariantService
{
    protected $variant;

    protected $inventoryService;

    public function __construct(VariantRepositopy $variantRepositopy, InventoryService $inventoryService)
    {
        $this->variant = $variantRepositopy;
        $this->inventoryService = $inventoryService;
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
        DB::transaction(function () use ($data) {

            $variantInput = $data;
            // dd($variantInput);

            //Kiểm tra sp biến nào có trùng không ?

            //Insert lên DB
            $variant = $this->variant->insert($variantInput);

            $variant_id = $variant->id;
            $product_id = $variantInput['product_id'];
            $quanity = $variantInput['stock'];

            if ($quanity > 0) {
                $this->inventoryService->importVariantStock($quanity, $product_id, $variant_id);
            }
        }, 3);

        return redirect()->route('admin.products.variants.index')->with('success', 'Thêm biến thể thành công');
    }

    public function update($data, $id)
    {

        DB::transaction(function () use ($data, $id) {
            //update lên DB
            $variantInput = $data;
            // dd($variantInput);

            $product_id = $variantInput['product_id'];
            $quanity = $variantInput['stock'];

            $currentStock = ProductVariant::where('id', $id)->value('stock');

            if ( $quanity > 0 && $quanity != $currentStock) {
                $this->inventoryService->adjustVariantStock($quanity, $product_id,$id);
            }

           $this->variant->updateById($variantInput, $id);
        }, 3);
        return redirect()->route('admin.products.variants.index')->with('success', 'Cập nhật biến thể thành công');
    }

    public function delete($data) {}
}
