<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupFormRequest extends FormRequest
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
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:9|max:11|unique:users',
            'password' => 'required|min:6|required_with:password_confirm|same:password_confirm',
            'password_confirm' => 'required|min:6|required_with:password|same:password',
            'address' => 'min:5',
        ];
    }

    public function messages()
    {
        return [
            'password_confirm.same' => 'Mật khẩu không trùng nhau'
        ];
    }
}
