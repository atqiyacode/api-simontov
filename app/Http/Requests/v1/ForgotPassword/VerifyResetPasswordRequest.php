<?php

namespace App\Http\Requests\v1\ForgotPassword;

use Illuminate\Foundation\Http\FormRequest;

class VerifyResetPasswordRequest extends FormRequest
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
    public function rules()
    {
        return [
            'verification_code' => 'required|numeric|digits:6',
            'nik' => 'required|exists:employees,nik',
            'code' => 'required|numeric|exists:users,username',
            'password' => 'required|string|confirmed|min:6',
        ];
    }

    public function messages()
    {
        return [
            'nik.exists' => 'NIK tidak terdaftar sebagai karyawan',
            'code.exists' => 'Karyawan belum terdaftar sebagai pengguna',
        ];
    }
}
