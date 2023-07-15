<?php

namespace App\Http\Requests\v1\Login;

use Illuminate\Foundation\Http\FormRequest;

class CheckUserPinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (bool) auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'pin' => 'required|numeric',
        ];
    }
}
