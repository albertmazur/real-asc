<?php

namespace App\Http\Requests\Store;

use App\Enums\Language;
use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('isAdmin', 'role');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255', 'min:2'],
            'last_name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'tel' => ['nullable', 'string', 'max:20', 'regex:/^\+?[0-9\- ]{7,20}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'change_password' => ['nullable', 'boolean'],
            'role' => ['required', Rule::enum(UserRole::class)],
            'language' => ['required', Rule::enum(Language::class)],
        ];
    }
}
