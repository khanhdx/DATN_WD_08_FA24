<?php

namespace App\Http\Requests\product\variant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVariantRequest extends FormRequest
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
            'color_id' => 'required|exists:colors,id', // Kiểm tra tồn tại trong bảng colors
            'size_id' => 'required|exists:sizes,id', // Kiểm tra tồn tại trong bảng szies
            'stock' => 'required|numeric|integer|min:0',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'color_id.required' => 'Màu sắc không được bỏ trống.',
            'color_id.exists' => 'Màu sắc không tồn tại.',

            'size_id.required' => 'Kích thước không được bỏ trống.',
            'size_id.exists' => 'Kích thước không tồn tại.',

            'stock.required' => 'Số lượng tồn kho không được bỏ trống.',
            'stock.numeric' => 'Số lượng tồn kho phải là một số.',
            'stock.integer' => 'Số lượng tồn kho phải là số nguyên.',
            'stock.min' => 'Số lượng tồn kho phải là số không âm.',

            'price.required' => 'Giá không được bỏ trống.',
            'price.numeric' => 'Giá phải là một số.',
            'price.min' => 'Giá phải lớn hơn hoặc bằng 0.',
        ];
    }
}
