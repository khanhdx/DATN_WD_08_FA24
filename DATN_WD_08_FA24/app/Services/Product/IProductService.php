<?php 

namespace App\Services\Product;

interface IProductService{
    public function getAll();

    public function getOneBy($id);

    public function insert($data);

    public function update($id, $data);

    public function delete($data);

}