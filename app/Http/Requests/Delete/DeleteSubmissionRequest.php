<?php

namespace App\Http\Requests\Delete;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('isAdminOrModerator', 'role');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:submissions,id']
        ];
    }
}
