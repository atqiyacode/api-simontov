<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['sometimes', 'string', 'unique:locations,code,' . $this->id],
            'name' => ['sometimes', 'string'],
            'longitude' => ['sometimes', 'numeric'],
            'lattitude' => ['sometimes', 'numeric'],
            'description' => ['sometimes'],
        ];
    }
}
