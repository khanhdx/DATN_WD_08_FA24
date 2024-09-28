<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorysRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages(): array{
        return [
            'name.required' => 'Tên danh mục không được để trống',
            'image.required' => 'Ảnh danh mục không được để trống',
            'image.image' => 'Ảnh danh mục phải là một ảnh',
            'image.mimes' => 'Ảnh danh mục phải có định dạng jpeg, png, jpg, gif',
            'image.max' => 'Ảnh danh mục không được lớn hơn 2MB',
        ];
    }
}
