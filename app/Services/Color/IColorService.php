<?php 

namespace App\Services\Color;

interface IColorService{
    public function getAll();
    public function getAllPaginate();
    public function getOne($id);

    public function insert($data);

    public function update($id, $data);

    public function delete($data);

}