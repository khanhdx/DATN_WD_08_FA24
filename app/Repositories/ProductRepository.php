<?php 

namespace App\Repositories;

use App\Models\Product;

class ProductRepository {
    public function getAll()
    {
        return Product::all();
    }

    public function getOneById($id)
    {
        return Product::findOrFail($id);
    }

    public function insert($data)
    {
        $data = Product::create($data);

        return $data;
    }

    public function updateById($data, $id)
    {
        $product = $this->getOneById($id);

        $updated = $product->update($data);

        if (!$updated) {
            throw new \Exception("Failed to update color.");
        }

        return $product;
    }

    public function softDeleteById($id)
    {
        Product::findOrFail($id)->delete();
        return true;
    }


    public function searchByName($keyword)
    {
        $products = Product::where('name', 'like', '%' . $keyword . '%');

        return $products;
    }

    // Lọc
    public function filter()
    {
        
    }
}