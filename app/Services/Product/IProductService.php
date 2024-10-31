<?php 

namespace App\Services\Product;

use Illuminate\Http\Request;

interface IProductService{
    public function getAll();

    public function getOneById($id);

    public function insert($data);

    public function update($id, $data);

    public function softDeleteById($id);

    public function search($keyword);

    public function filter($request);

}