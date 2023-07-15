<?php

namespace App\Http\Requests\v1\Register;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCheckRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'nik' => 'required|exists:employees,nik',
            'code' => 'required|exists:employees,code|unique:users,username',
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
