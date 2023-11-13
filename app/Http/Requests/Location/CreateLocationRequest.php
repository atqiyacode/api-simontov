<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class CreateLocationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'unique:locations,code'],
            'name' => ['required', 'string'],
            'longitude' => ['required', 'numeric'],
            'lattitude' => ['required', 'numeric'],
            'description' => ['nullable'],
        ];
    }
}
