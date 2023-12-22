<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class CreateSliderRequest extends FormRequest
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
            'name' => 'required|unique:sliders',
            'description' => 'required|min:10',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Trường "Tên sản phẩm" không được bỏ trống',
            'description.required'=> 'Trường "mô tả" không được bỏ trống',
            'description.min'=> 'Trường "mô tả" phải ít nhất 10 ký tự',

        ];
    }
}