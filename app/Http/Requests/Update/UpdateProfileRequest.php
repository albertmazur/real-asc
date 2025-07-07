<?php

namespace App\Http\Requests\Update;

use App\Enums\Language;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'id' => ['nullable', 'exists:users,id'],
            'first_name' => ['required', 'string', 'max:255', 'min:2'],
            'last_name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user()->id)],
            'tel' => ['required', 'string', 'max:20', 'regex:/^\+?[0-9\- ]{7,20}$/'],
            'language' => ['required', Rule::enum(Language::class)],
            'role' => ['nullable', Rule::enum(UserRole::class)],
            'password' => ['nullable', 'min:8', 'confirmed']
        ];
    }

    public function messages()
    {
        return [
            'language.required' => __('validation.language_required'),
            'language.in' => __('validation.language_invalid'),
        ];
    }

    public function withValidator($validator)
{
    $validator->after(function (Validator $validator) {
        $currentUser = $this->user();

        $isRemovingAdmin = (
            $currentUser->role === UserRole::ADMIN->value &&
            $this->input('role') !== UserRole::ADMIN->value
        );

        if ($isRemovingAdmin) {
            $adminCount = User::where('role', UserRole::ADMIN->value)
                ->where('id', '!=', $currentUser->id)
                ->count();

            if ($adminCount < 1) {
                $validator->errors()->add('role', __('validation.at_least_one_admin'));
            }
        }
    });
}
}