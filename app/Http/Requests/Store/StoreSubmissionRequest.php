<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSubmissionRequest extends FormRequest
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
            'reason' => ['required', 'string', Rule::in(['offensive', 'vulgar', 'other'])],
            'content' => ['string'],
            'comment_id' => ['required', 'integer']
        ];
    }

    public function messages()
    {
        return [
            'reason.in' => 'Pole reason musi mieć jedną z wartości: Obrażliwe, Wulgarne lub Inne.',
        ];
    }
}
