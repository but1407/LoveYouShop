<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class CreateSettingRequest extends FormRequest
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
            'config_key' =>'required|max:255',
            'config_value' =>'required|max:255'

        ];
    }
    public function messages() :array{
        return [
            'config_key.required' => 'Trường "Config key" không được bỏ trống',
            'config_value.required' => 'Trường "Config value" không được bỏ trống',
            
           
        ];
    }
}