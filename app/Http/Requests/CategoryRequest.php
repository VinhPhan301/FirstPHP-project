<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'thumbnail.required' => 'Không để trống trường ảnh',
            'thumbnail.image' => 'Phải là ảnh',
            'thumbnail.mimes' => 'File phải có định dạng jpg, jpeg, png, gif',
            'thumbnail.max' => 'File có dung lượng tối đa 2mb'
        ];
    }
}
