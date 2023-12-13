<?php

namespace App\Http\Requests\Tax;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaxRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'value' => ['required', 'numeric'],
        ];
    }
}
