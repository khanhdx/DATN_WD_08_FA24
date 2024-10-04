<?php

namespace App\Repositories;

use App\Models\ProductImage;

class ImageRepository {
    public function getAll()
    {
        
    }

    public function insert($data){
        return ProductImage::create($data);
    }

    public function update($data, $id){
        $image = ProductImage::findOrFail($id);

        return $image->update($data);
    }


    public function destroy($id)
    {
        $image = ProductImage::findOrFail($id);

        return $image->delete();
    }
}