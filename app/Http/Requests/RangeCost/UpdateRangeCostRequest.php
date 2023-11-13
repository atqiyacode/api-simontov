<?php

namespace App\Http\Requests\RangeCost;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRangeCostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'range_type_id' => ['sometimes', 'unique:range_costs,range_type_id,' . $this->id],
            'value' => ['sometimes', 'numeric'],
        ];
    }
}
