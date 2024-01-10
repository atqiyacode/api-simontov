<?php

namespace App\Http\Requests\Tax;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaxRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'value' => ['sometimes', 'numeric'],
        ];
    }
}
