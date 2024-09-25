<?php

namespace App\Repositories;

use App\Models\Size;

class SizeRepository
{
    public function getAll()
    {
        return Size::all();
    }

    public function getOne($id_size)
    {

        return Size::where('id_size', $id_size)->get();
    }

    public function insert($data)
    {
        $data = Size::create($data);

        return $data;
    }

    public function update($id_size, $data)
    {
        $updated = Size::query()->where('id_size', $id_size)->update($data);
        if (!$updated) {
            throw new \Exception("Failed to update size.");
        }

        $size = $this->getOne($id_size);
        return $size;
    }

    public function delete($id_size)
    {
        Size::query()->where('id_size', $id_size)->delete();
        return true;
    }
}
