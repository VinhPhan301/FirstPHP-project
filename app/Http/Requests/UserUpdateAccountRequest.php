<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateAccountRequest extends FormRequest
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
            'name' => 'required|min:6',
            'phone' => 'required|min:10|max:12',
            'date_of_birth' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'date_of_birth.required' => 'Ngày sinh không được để trống.',
            'name.min' => 'Tên phải có ít nhất 6 ký tự.'
        ];
    }
}
