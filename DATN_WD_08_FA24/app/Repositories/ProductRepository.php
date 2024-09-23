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
        return Product::find($id);
    }

    public function insert($data)
    {
        $data = Product::create($data);

        return $data;
    }

    public function updateById($id, $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function deleteById($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
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