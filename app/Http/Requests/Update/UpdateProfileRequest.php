<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|min:2'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.name_required'),
            'name.min' => __('validation.name_min'),
            'name.max' => __('validation.name_max')
        ];
    }
}