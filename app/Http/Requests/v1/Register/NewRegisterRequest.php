<?php

namespace App\Http\Requests\v1\Register;

use Illuminate\Foundation\Http\FormRequest;

class NewRegisterRequest extends FormRequest
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
            'code' => 'required|alpha_num|max:20|unique:users,username|exists:employees,code',
            'phone' => 'required|numeric|digits_between:10,15|unique:users,phone|min:10',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'phone.exists' => trans('validation.exists', ['attribute' => trans('client.phone_number')]),
            'phone.numeric' => trans('validation.numeric', ['attribute' => trans('client.phone_number')]),
            'phone.digits_between' => trans('validation.digits_between', ['attribute' => trans('client.phone_number')]),
            'phone.unique' => trans('validation.unique', ['attribute' => trans('client.phone_number')]),
            'phone.min' => trans('validation.min', ['attribute' => trans('client.phone_number')]),
        ];
    }
}
