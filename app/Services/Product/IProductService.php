<?php 

namespace App\Services\Product;

interface IProductService{
    public function getAll();

    public function getOneById($id);

    public function insert($data);

    public function update($id, $data);

    public function softDeleteById($id);

}