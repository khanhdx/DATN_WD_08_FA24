<?php

namespace App\Http\Requests\image;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id'    => 'required|integer',
            'image_main'    => 'required|image',
            'image_others'  => 'required',
        ];
    }
    public function messages()
    {
        return [
            'product_id.required' => 'Vui lòng chọn sản phẩm!',
            'product_id.integer' => 'Hiện tại tất cả sản phẩm đều có ảnh.<br> Không thể thêm được nữa!',
            'image_main.required' => 'Vui lòng chọn ảnh chính!',
            'image_others.required' => 'Vui lòng chọn ảnh phụ!',
        ];
    }

}
