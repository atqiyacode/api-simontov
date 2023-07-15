<?php

namespace App\Http\Requests\v1\Client;

use Illuminate\Foundation\Http\FormRequest;


class UpdatePinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_pin' => 'required|numeric|digits:6',
            'pin' => 'nullable|numeric|digits:6|confirmed',
            'password' => 'required|string|min:5',
        ];
    }
}
