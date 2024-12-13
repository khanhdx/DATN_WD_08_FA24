<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll()
    {
        return Product::orderByDesc('id')->paginate(10);
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


    public function search($keyword)
    {
        $products = Product::where(function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('SKU', 'like', '%' . $keyword . '%');
        })->paginate(10);

        return $products;
    }

}
