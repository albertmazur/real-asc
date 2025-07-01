<?php

namespace App\Http\Requests\Update;

use App\Enums\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255', 'min:2'],
            'last_name' => ['required', 'string', 'max:255', 'min:2'],
            'tel' => ['required', 'string', 'max:20', 'regex:/^\+?[0-9\- ]{7,20}$/'],
            'language' => ['required', Rule::in(array_column(Language::cases(), 'value'))]
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