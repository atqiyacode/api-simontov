<?php

namespace App\Http\Requests\RangeType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRangeTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'label' => 'required|string|max:100|unique:range_types,label,' . $this->id,
            'lower_limit' => 'required|numeric',
            'upper_limit' => 'required|numeric|gt:lower_limit',
            'description' => 'nullable|string|max:144',
        ];
    }
}
