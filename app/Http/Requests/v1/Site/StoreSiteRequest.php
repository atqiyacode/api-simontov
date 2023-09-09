<?php

namespace App\Http\Requests\v1\Site;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiteRequest extends FormRequest
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
            'code' => 'required|unique:sites,code',
            'name' => 'required|string|max:100',
            'longitude' => 'required|numeric',
            'lattitude' => 'required|numeric',
            'description' => 'nullable|string|max:500',
        ];
    }
}
