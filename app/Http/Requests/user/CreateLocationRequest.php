<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class CreateLocationRequest extends FormRequest
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
            //
            'location_name'=>'required|string|max:255',
            'user_name'=>'required|string|max:255',
            'phone_number'=>'required|numeric',
            'location_detail'=>'required|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            //
            'location_name.required'=>'Vui lòng không bỏ trống tên địa chỉ',
            'location_name.string'=>'Tên địa chỉ phải là một chuỗi',
            'location_name.max'=>'Tên địa chỉ quá dài',
            'user_name.required'=>'Vui lòng không bỏ trống tên người nhận',
            'user_name.string'=>'Tên không hợp lệ',
            'user_name.max'=>'Tên quá dài',
            'user_name.unique'=>'Tài khoản đã tồn tại',
            'phone_number.required'=>'Vui lòng không bỏ trống số điện thoại',
            'phone_number.numeric'=>'Số điện thoại không hợp lệ',
            'location_detail.required'=>'Vui lòng không bỏ trống địa chỉ',
            'location_detail.string'=>'địa chỉ phải là một chuỗi',
            'location_detail.max'=>'địa chỉ quá dài',
        ];
    }
}
