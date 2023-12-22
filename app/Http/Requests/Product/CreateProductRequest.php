<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'category_id' =>'required',
            'tags'=>'required',
            'price'=>'required',
        ];
    }
    public function messages() :array{
        return [
            'name.required' => 'Trường "Tên sản phẩm" không được bỏ trống',
            'category_id.required' => 'Trường "chọn danh Mục" không được bỏ trống',
            'tags.required' => 'Trường "Tags" không được bỏ trống',
            'price.required' => 'Trường "Giá gốc" không được bỏ trống',
        ];
    }
}