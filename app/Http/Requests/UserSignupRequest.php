<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSignupRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'name' => 'required|min:6',
            'password' => 'required|min:6|required_with:password_confirm|same:password_confirm',
            'password_confirm' => 'required|min:6|required_with:password|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password_confirm.same' => 'Mật khẩu không trùng nhau'
        ];
    }
}
