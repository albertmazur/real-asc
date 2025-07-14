<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => ['required', 'string', 'exists:tickets,qr_token'],
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => __('validation.token_required'),
            'token.size' => __('validation.token_invalid'),
        ];
    }
}
