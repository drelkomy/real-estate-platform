<?php

namespace App\Modules\Identity\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('manage users') ?? true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'exists:roles,name'],
            'phone' => ['nullable', 'string', 'max:30'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['boolean'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('The name field is required.'),
            'email.required' => __('The email field is required.'),
            'email.unique' => __('This email is already in use.'),
            'password.required' => __('The password field is required.'),
            'password.min' => __('Password must be at least 8 characters.'),
            'role.required' => __('Please select a valid role.'),
        ];
    }
}
