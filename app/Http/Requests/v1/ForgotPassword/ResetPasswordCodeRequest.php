<?php

namespace App\Http\Requests\v1\ForgotPassword;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordCodeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'method' => 'required|in:whatsapp,email',
            'nik' => 'required|min:14|exists:employees,nik',
            'code' => 'required|alpha_num|max:20|exists:users,username',
        ];
    }
}
