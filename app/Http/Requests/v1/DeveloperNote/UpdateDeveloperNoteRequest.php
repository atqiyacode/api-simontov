<?php

namespace App\Http\Requests\v1\DeveloperNote;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeveloperNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole(['privateAccess']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'label' => 'required|string|max:50',
            'content' => 'required|string|max:150000',
        ];
    }
}
