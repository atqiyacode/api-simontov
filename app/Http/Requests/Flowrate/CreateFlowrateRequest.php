<?php

namespace App\Http\Requests\Flowrate;

use Illuminate\Foundation\Http\FormRequest;

class CreateFlowrateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'location_id' => ['required'],
			'flowrate' => ['required', 'string'],
        ];
    }
}
