<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'=>'required|string|max:255',
            'email'=>'required|string|max:255',
            'phone_number'=>'required|numeric',
        ];
    }
    public function messages(): array
    {
        return [
            //
            'name.required'=>'Vui lòng không bỏ trống tên',
            'name.string'=>'Tên phải là một chuỗi',
            'name.max'=>'Tên quá dài',
            'email.required'=>'Vui lòng không bỏ trống email',
            'email.string'=>'Email không hợp lệ',
            'email.max'=>'Email quá dài',
            'phone_number.required'=>'Vui lòng không bỏ trống số điện thoại',
            'phone_number.numeric'=>'Số điện thoại không hợp lệ',
        ];
    }
}
