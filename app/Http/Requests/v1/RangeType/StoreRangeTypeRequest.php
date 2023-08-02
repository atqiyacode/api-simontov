<?php

namespace App\Http\Requests\v1\RangeType;

use Illuminate\Foundation\Http\FormRequest;

class StoreRangeTypeRequest extends FormRequest
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
            'label' => 'required|string|max:100|unique:range_types,label',
            'lower_limit' => 'required|numeric',
            'upper_limit' => 'required|numeric|gt:lower_limit',
            'description' => 'nullable|string|max:144',
        ];
    }
}
