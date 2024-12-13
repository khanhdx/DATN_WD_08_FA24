<?php

namespace App\Repositories;

use App\Models\Color;
use Illuminate\Support\Facades\DB;

class ColorRepository
{
    public function getAll()
    {
        return Color::paginate(5);
    }

    public function getOne($id)
    {

        return Color::find($id);
    }

    public function insert($data)
    {
        $data = Color::create($data);

        return $data;
    }

    public function update($id, $data)
    {
        $color = $this->getOne($id);

        $updated = $color->update($data);

        if (!$updated) {
            throw new \Exception("Failed to update color.");
        }

        return $color;
    }

    public function delete($id)
    {
        Color::query()->where('id', $id)->delete();
        return true;
    }

    
}
