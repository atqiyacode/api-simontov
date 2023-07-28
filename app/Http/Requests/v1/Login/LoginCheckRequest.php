<?php

namespace App\Http\Requests\v1\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginCheckRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:5',
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => trans('validation.exists'),
            'email.alpha_num' => trans('validation.alpha_num'),
        ];
    }
}
