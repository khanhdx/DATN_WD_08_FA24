<?php

namespace App\Services\Size;

use App\Repositories\SizeRepository;
use Illuminate\Support\Facades\Validator;

class SizeService implements ISizeService
{

    protected $sizeRepository;

    public function __construct(SizeRepository $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    public function getAll()
    {
        // Xử lý nhiệp vụ 

        $sizes = $this->sizeRepository->getAll();

        return  $sizes;
    }


    public function getOne($id)
    {
        $size = $this->sizeRepository->getOne($id);

        return $size;
    }

    public function insert($data)
    {

        try {
            $this->sizeRepository->insert($data);

            return redirect()->back()->with('success', 'Thêm size thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', $th->getMessage());
        }
    }

    public function update($id, $data)
    {

        $size = $this->sizeRepository->getOne($id);

        // Kiểm tra size có tồn tại không ? 
        if (!$size) {
            return redirect()->back()->with('failed', 'Size không tồn tại');
        }

        try {
            $this->sizeRepository->update($id, $data);

            return redirect()->back()->with('success', 'Cập nhật size thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    public function delete($id)
    {
        $size = $this->sizeRepository->getOne($id);

        // Kiểm tra size có tồn tại không ? 
        if (!$size) {
            return redirect()->back()->with('failed', 'Size không tồn tại');
        }


        try {
            $deleted = $this->sizeRepository->delete($id);

            if ($deleted) {
                return redirect()->back()->with('success', "Xóa size $size->name thành công");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Xóa size thát bại. Vul lòng thử lại');
        }
    }
}
