<?php 

namespace DATN_WD_08_FA24\App\Repositories\Category;

use App\Models\Color;

class ColorRepository {

    public function getAll(){
        return Color::all();
    }


    public function getOneByID($id){
        $data = $id ? Color::findOrFail($id) : Color::all();
        return $data;
    }

    public function insert($dataInput){
        return Color::create($dataInput);
    }

    public function update($id, $dataInput){
        $user = Color::findOrFail($id);
        return $user->update($dataInput);
    }

    public function deleteById($id){
        $user = Color::findOrFail($id);
        $user->delete();
        return true;
    }
}