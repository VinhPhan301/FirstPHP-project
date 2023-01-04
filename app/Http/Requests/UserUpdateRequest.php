<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'phone' => 'required|min:10|max:12',
            'date_of_birth' => 'required',
            'address' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'Tên phải có ít nhất 6 ký tự.',
            'phone.unique' => 'Số điện thoại đã tồn tại'
        ];
    }
}
