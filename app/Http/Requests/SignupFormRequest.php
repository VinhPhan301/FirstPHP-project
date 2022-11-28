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
            'email' => 'required|email',
            'phone' => 'required|min:9|max:11',
            'password' => 'min:6|required_with:password_confirm|same:password_confirm',
            'password_confirm' => 'required|min:6',
            'address' => 'required|min:5',
            'date_of_birth' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name' => 'Ten khong hop le',
            'email' => 'Email khong hop le',
            'password' => 'Password khong trung nhau',
            'address' => 'Address khong hop le',
            'phone' => 'Phone khong hop le',
            'date_of_birth' => 'Date of Birth khong hop le',
        ];
    }
}
