<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'thumb' => 'required',
            'description' => 'required',
            'content' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm!',
            'thumb.required' => 'Ảnh đại diện không được trống!',
            'description.required' => 'Vui lòng nhập mô tả!',
            'content.required' => 'Vui lòng nhập mô tả chi tiết!'
        ];
    }
}
