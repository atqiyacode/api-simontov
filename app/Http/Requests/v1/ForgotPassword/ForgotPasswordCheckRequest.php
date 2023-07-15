<?php

namespace App\Http\Requests\v1\ForgotPassword;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordCheckRequest extends FormRequest
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
    public function rules()
    {
        return [
            'nik' => 'required|exists:employees,nik',
            'code' => 'required|numeric|exists:users,username',
        ];
    }

    public function messages()
    {
        return [
            'nik.exists' => trans('validation.exists', ['attribute' => trans('client.employee_nik')]),
            'code.exists' => trans('validation.exists', ['attribute' => trans('client.employee_code')]),
            'code.unique' => trans('validation.unique', ['attribute' => trans('client.employee_code')]),
        ];
    }
}
