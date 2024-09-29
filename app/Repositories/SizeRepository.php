<?php

namespace App\Repositories;

use App\Models\Size;

class SizeRepository
{
    public function getAll()
    {
        return Size::all();
    }

    public function getOne($id)
    {
        return Size::findOrFail($id);
    }

    public function insert($data)
    {
        $data = Size::create($data);

        return $data;
    }

    public function update($id, $data)
    {
        $size = $this->getOne($id);

        $updated = $size->update($data);
        if (!$updated) {
            throw new \Exception("Failed to update size.");
        }

        return $size;
    }

    public function delete($id)
    {
        Size::query()->where('id', $id)->delete();
        return true;
    }
}
