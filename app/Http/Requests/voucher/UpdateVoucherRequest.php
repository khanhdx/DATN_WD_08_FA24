<?php

namespace App\Http\Requests\voucher;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVoucherRequest extends FormRequest
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
            'voucher_code'=>'required|max:255',
            'decreased_value'=>'required|numeric|max:9999999999',
            'max_value'=>'required|numeric|max:9999999999',
            'quanlity'=>'integer|required',
            'condition'=>'required|numeric|max:9999999999',
            'date_start'=>'required',
            'date_end'=>'required|after:date_start',
            'type_code'=>'required',
            'description'=>'string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            //
            'name.required'=>'Không thể bỏ trống tên!',
            'name.string'=>'Tên không hợp lệ!',
            'name.max'=>'Tên quá dài!',
            'voucher_code.required'=>'Không thể bỏ trống mã!',
            'voucher_code.max'=>'Mã quá lớn!',
            'decreased_value.required'=>'Không thể bỏ trống mức giảm!',
            'decreased_value.numeric'=>'Mức giảm không hợp lệ!',
            'decreased_value.max'=>'Mức giả quá lớn!',
            'max_value.required'=>'Không thể bỏ trống mức giảm tối đa!',
            'max_value.numeric'=>'Mức giảm không hợp lệ!',
            'max_value.max'=>'Mức giảm quá lơn!',
            'quanlity.integer'=>'Số lượng không hợp lệ!',
            'quanlity.required'=>'Không thể bỏ trống số lượng!',
            'condition.required'=>'Không thể bỏ trống điều kiện!',
            'condition.numeric'=>'Điều kiện không hợp lệ!',
            'condition.max'=>'Điều kiện quá dài!',
            'date_start.required'=>'Không thể bỏ trống ngày bắt đầu!',
            'date_start.after'=>'Ngày bắt đầu không hợp lệ!',
            'date_end.required'=>'Không thể bỏ trống ngày kết thúc!',
            'date_end.after'=>'Ngày kết thúc không hợp lệ!',
            'type_code.required'=>'Không thể bỏ trống kiểu!',
            'description.string'=>'Mô tả không hợp lệ!',
            'description.max'=>'Mô tả quá dài!',
        ];
    }
}
