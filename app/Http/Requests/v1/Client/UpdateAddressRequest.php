<?php

namespace App\Http\Requests\v1\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'province' => 'required|exists:indonesia_provinces,id',
            'city' => 'required|exists:indonesia_cities,id',
            'district' => 'required|exists:indonesia_districts,id',
            'village' => 'required|exists:indonesia_villages,id',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'post_code' => 'required|numeric|digits:5',
            'detail' => 'required|string|max:100'
        ];
    }
}
