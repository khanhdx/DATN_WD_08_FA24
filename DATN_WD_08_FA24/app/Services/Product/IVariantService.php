<?php 

namespace App\Services\Product;

interface IVariantService{
    public function getAll();

    public function getOneById($id);

    public function insert($data);

    public function update($data, $id);

    public function delete($data);

}