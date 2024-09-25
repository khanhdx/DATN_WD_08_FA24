<?php

namespace App\Repositories;

use App\Models\Color;
use Illuminate\Support\Facades\DB;

class ColorRepository
{
    public function getAll()
    {
        return Color::all();
    }

    public function getOne($id_color)
    {

        return Color::where('id_color', $id_color)->get();
    }

    public function insert($data)
    {
        $data = Color::create($data);

        return $data;
    }

    public function update($id_color, $data)
    {
        

        $updated = Color::query()->where('id_color', $id_color)->update($data);

        if (!$updated) {
            throw new \Exception("Failed to update color.");
        }

        $color = $this->getOne($id_color);
        
        return $color;
    }

    public function delete($id_color)
    {
        Color::query()->where('id_color', $id_color)->delete();
        return true;
    }
}
