<?php

namespace App\Http\Requests\image;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageRequest extends FormRequest
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
            'product_id'    => 'required',
            'image_main'    => 'nullable|image',
            'image_others'  => 'nullable',
        ];
    }
    
    public function messages()
    {
        return [
            'product_id.required' => 'Vui lòng chọn sản phẩm!',
            // 'image_others.required' => 'Vui lòng UPLOAD ảnh phụ cần chỉnh sửa!',
        ];
    }
}
