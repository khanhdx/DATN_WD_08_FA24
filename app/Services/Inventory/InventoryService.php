<?php

namespace App\Services\Inventory;

use App\Models\InventoryStock;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    public function importVariantStock($stock_change, $productId, $variantId)
    {


        // Tạo bản ghi trong inventory_stocks
        InventoryStock::create([
            'product_id' => $productId,
            'product_variant_id' => $variantId,
            'stock_change' => $stock_change,
            'type' => 'Nhập hàng',
        ]);

        // Tính toán tồn kho mới cho biến thể
        $currentVarriantStock = InventoryStock::where('product_variant_id', $variantId)->sum('stock_change');
        ProductVariant::where('id', $variantId)->update(['stock' => $currentVarriantStock]);

        // Tính toán tồn kho tổng cho sản phẩm
        $totalProductStock = ProductVariant::where('product_id', $productId)->sum('stock');
        Product::where('id', $productId)->update(['base_stock' => $totalProductStock]);
    }

    public function exportVariantStock($stock_change, $productId, $variantId)
    {

        $currentStock = ProductVariant::where('id', $variantId)->value('stock');

        if ($currentStock < $stock_change) {
            return redirect()->back()->with(['message' => 'Số lượng không đủ']);
        }

        // Tạo bản ghi trong inventory_stocks
        InventoryStock::create([
            'product_id' => $productId,
            'product_variant_id' => $variantId,
            'stock_change' => $stock_change,
            'type' => 'Xuất hàng',
        ]);

        // Tính toán tồn kho mới cho biến thể
        $currentVarriantStock = InventoryStock::where('product_variant_id', $variantId)->sum('stock_change');
        ProductVariant::where('id', $variantId)->update(['stock' => $currentVarriantStock]);

        // Tính toán tồn kho tổng cho sản phẩm
        $totalProductStock = ProductVariant::where('product_id', $productId)->sum('stock');
        Product::where('id', $productId)->update(['base_stock' => $totalProductStock]);
    }

    public function adjustVariantStock($stock_change, $productId, $variantId)
    {

        $preVariantStock = ProductVariant::where('id', $variantId)->value('stock');
        

        // Tạo bản ghi trong inventory_stocks
        InventoryStock::create([
            'product_id' => $productId,
            'product_variant_id' => $variantId,
            'stock_change' => $stock_change,
            'type' => 'Chỉnh sửa tồn kho',
        ]);

        // Tính toán tồn kho mới cho biến thể
        ProductVariant::where('id', $variantId)->update(['stock' => $stock_change]);
        $reVariantStock = ProductVariant::where('id', $variantId)->value('stock');
  

        // Tính toán tồn kho tổng cho sản phẩm
        $tolalProductStock = Product::where('id', $productId)->value('base_stock');
        $tolalProductStock += $reVariantStock - $preVariantStock;

        Product::where('id', $productId)->update(['base_stock' => $tolalProductStock]);
    }

    public function getAll()
    {
        $data = DB::table('inventory_stocks')
            ->join('products', 'products.id', '=', 'inventory_stocks.product_id')
            ->join('product_variants', 'product_variants.id', '=', 'inventory_stocks.product_variant_id')
            ->join('colors', 'colors.id', '=', 'product_variants.color_id')
            ->join('sizes', 'sizes.id', '=', 'product_variants.size_id')
            ->select('inventory_stocks.*', 'products.name as product_name', 'colors.name as color_name', 'sizes.name as size_name')
            ->orderByDesc('id')
            ->get();

        return $data;
    }
}
