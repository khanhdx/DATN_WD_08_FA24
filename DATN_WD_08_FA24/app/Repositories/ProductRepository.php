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
        return Product::where('id_color', $id)->get();
    }

    public function insert($data)
    {
        $data = Product::create($data);

        return $data;
    }

    public function updateById($id_product, $data)
    {
       
        $updated = Product::query()->where('id_color', $id_product)->update($data);

        if (!$updated) {
            throw new \Exception("Failed to update color.");
        }

        $product = $this->getOneById($id_product);

        return $product;
    }

    public function deleteById($id)
    {
        Product::query()->where('id_color', $id)->delete();
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