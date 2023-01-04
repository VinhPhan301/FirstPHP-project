<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'required|max:2048',
            'price' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Không để trống trường ảnh',
            'image.image' => 'Phải là ảnh',
            'image.mimes' => 'File phải có định dạng jpg, jpeg, png, gif',
            'image.max' => 'File có dung lượng tối đa 2mb',
            'price.required' => 'Đơn giá không được để trống'
        ];
    }
}
