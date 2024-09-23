<?php 

namespace App\Repositories;

use App\Models\Color;

class ColorRepository {
    public function getAll()
    {
        return Color::all();
    }

    public function insert($data)
    {
        $data = Color::create($data);

        return $data;
    }

    public function update($id, $data)
    {
        $color = Color::findOrFail($id);
        $color->update($data);
        return $color;
    }

    public function delete($id)
    {
        $color = Color::findOrFail($id);
        $color->delete();
        return true;
    }
}