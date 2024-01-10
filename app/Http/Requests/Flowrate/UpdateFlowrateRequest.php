<?php

namespace App\Http\Requests\Flowrate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFlowrateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'location_id' => ['sometimes'],
			'flowrate' => ['sometimes', 'string'],
        ];
    }
}
