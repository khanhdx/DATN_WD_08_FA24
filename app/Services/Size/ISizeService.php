<?php 

namespace App\Services\Size;

interface ISizeService{
    public function getAll();

    public function getOne($id);

    public function insert($data);

    public function update($id, $data);

    public function delete($data);

}