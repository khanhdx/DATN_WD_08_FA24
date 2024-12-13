<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id', // Kiểm tra tồn tại trong bảng categories
            'name' => 'required|unique:products,name',
            'SKU' => 'required|unique:products,SKU',
            'price_regular' => 'required|numeric|min:0',
            'price_sale' => 'numeric|min:0|lt:price_regular',
            'description' => 'max:255',
            'content' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Danh mục không được để trống.',
            'category_id.exists' => 'Danh mục không tồn tại.',
            'name.required' => 'Tên không để trống',
            'name.unique' => 'Tên đã tồn tại',
            'SKU.required' => 'Mã sản phẩm không để trống',
            'SKU.unique' => 'Mã sản phẩm đã tồn tại',
            'price_regular.required' => 'Giá gốc không được để trống.',
            'price_regular.numeric' => 'Giá gốc phải là số.',
            'price_regular.min' => 'Giá gốc không được âm.',
            'price_sale.numeric' => 'Giá khuyến mãi phải là số.',
            'price_sale.min' => 'Giá khuyến mãi không được âm.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'description.max' => 'Mô tả ngắn không được vượt quá 255 ký tự.',
        ];
    }
}
