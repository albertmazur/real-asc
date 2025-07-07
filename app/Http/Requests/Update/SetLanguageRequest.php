<?php

namespace App\Http\Requests\Update;

use App\Enums\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SetLanguageRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'language' => ['required', Rule::enum(Language::class)]
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