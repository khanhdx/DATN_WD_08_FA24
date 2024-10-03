<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tối đa 2MB
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
            'email.unique' => 'Email đã được sử dụng.',
            'phone_number.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'user_image.image' => 'Tập tin không phải là hình ảnh.',
            'user_image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'user_image.max' => 'Hình ảnh không được lớn hơn 2MB.',
        ];
    }
}
