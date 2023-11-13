<?php

namespace App\Http\Requests\RangeCost;

use Illuminate\Foundation\Http\FormRequest;

class CreateRangeCostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'range_type_id' => ['required', 'unique:range_costs,range_type_id'],
            'value' => ['required', 'numeric'],
        ];
    }
}
