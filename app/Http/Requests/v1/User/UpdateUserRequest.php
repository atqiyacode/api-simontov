<?php

namespace App\Http\Requests\v1\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|alpha_num|unique:users,username,' . $this->user->id,
            'email' => 'sometimes|unique:users,email,' . $this->user->id,
            'phone' => 'nullable|numeric|digits_between:11,14|unique:users,phone,' . $this->user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'roles' => 'required|array|exists:roles,id',
            'permissions' => 'sometimes|array|exists:permissions,id',
            'pin' => ['nullable', 'numeric', 'digits:6', 'confirmed',],
        ];
    }
}
