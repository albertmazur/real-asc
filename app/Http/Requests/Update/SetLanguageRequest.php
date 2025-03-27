<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class SetLanguageRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'language' => 'required|in:pl,en'
        ];
    }

    public function messages()
    {
        return [
            'language.required' => __('validation.language_required'),
            'language.in' => __('validation.language_invalid')
        ];
    }
}