<?php

namespace App\Services\Color;

use App\Repositories\ColorRepository;
use Illuminate\Support\Facades\Validator;

class ColorService implements IColorService
{

    protected $colorRepository;

    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }
    public function getAll()
    {
        // Xử lý nhiệp vụ 

        $colors = $this->colorRepository->getAll();

        return $colors;
    }
    public function getAllPaginate()
    {
        // Xử lý nhiệp vụ 

        $colors = $this->colorRepository->getAllPaginate();

        return $colors;
    }


    public function getOne($id_color)
    {
        $color = $this->colorRepository->getOne($id_color);

        return $color;
    }

    public function insert($data)
    {

        try {
            $this->colorRepository->insert($data);

            return redirect()->back()->with('success', 'Thêm màu sắc thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    public function update($id, $data)
    {

        $color = $this->colorRepository->getOne($id);

        // Kiểm tra Color có tồn tại không ? 
        if (!$color) {
                return redirect()->back()->with('failed', 'Màu sắc không tồn tại');
        }

        try {
            $this->colorRepository->update($id, $data);

            return redirect()->back()->with('success', 'Cập nhật màu sắc thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    public function delete($id)
    {
        $color = $this->colorRepository->getOne($id);


        if (!$color) {
            return redirect()->back()->with('failed', 'Màu sắc không tồn tạo');
        }

        try {
            $deleted = $this->colorRepository->delete($id);

            if ($deleted) {
                return redirect()->back()->with('success', 'Xóa màu sắc thành công');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Màu sắc đang tồn tại ở sản phẩm. Không thể xóa');
        }
    }
}
