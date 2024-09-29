<?php

namespace App\Repositories;

use App\Models\ProductVariant;

class VariantRepositopy {

    public function getAll()
    {
        return ProductVariant::all();
    }

    public function getOneById($id)
    {
        return ProductVariant::findOrFail($id);
    }

    public function insert($data)
    {
        $data = ProductVariant::create($data);

        return $data;
    }

    public function updateById($data, $id)
    {
        $variant = $this->getOneById($id);

        $updated = $variant->update($data);

        if (!$updated) {
            throw new \Exception("Failed to update color.");
        }

        return $variant;
    }

    public function deleteById($id)
    {
        ProductVariant::findOrFail($id)->delete();
        return true;
    }



}