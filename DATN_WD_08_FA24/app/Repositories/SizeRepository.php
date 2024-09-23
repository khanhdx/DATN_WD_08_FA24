<?php 

namespace App\Repositories;

use App\Models\Size;

class SizeRepository {
    public function getAll()
    {
        return Size::all();
    }

    public function insert($data)
    {
        $data = Size::create($data);

        return $data;
    }

    public function update($id, $data)
    {
        $size = Size::findOrFail($id);
        $size->update($data);
        return $size;
    }

    public function delete($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        return true;
    }
}