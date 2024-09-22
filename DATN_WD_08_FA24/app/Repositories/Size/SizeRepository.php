<?php 

namespace DATN_WD_08_FA24\App\Repositories\Size;

use App\Models\Size;

class  SizeRepository{

    public function getAll(){

        return Size::all();
    }


    public function getOneByID($id){

        $data = $id ? Size::findOrFail($id) : Size::all();
        return $data;
        
    }

    public function insert($dataInput){
        return Size::create($dataInput);
    }

    public function update($id, $dataInput){
        $user = Size::findOrFail($id);
        return $user->update($dataInput);
    }

    public function deleteById($id){
        $user = Size::findOrFail($id);
        $user->delete();
        return true;
    }
}