<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'value' => ['nullable', 'string'],
            'sortSearch' => ['nullable', 'string', Rule::in(['name', 'date', 'stadium', 'freeSet'])],
            'sortDirection' => ['nullable', 'string', Rule::in(['asc', 'desc'])],
            'facility' => ['nullable', 'integer', 'exclude_if:facility,0', Rule::exists('stadiums', 'id')],
            'filterData' => ['nullable', Rule::in(['past', 'future'])]
        ];
    }
}
