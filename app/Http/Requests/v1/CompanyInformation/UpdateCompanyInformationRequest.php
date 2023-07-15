<?php

namespace App\Http\Requests\v1\CompanyInformation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasAnyRole(['privateAccess', 'superadmin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:20',
            'title_en' => 'required|string|max:20',
            'description' => 'required|string|max:200',
            'description' => 'required|string|max:200',
            'status' => 'required|boolean',
        ];
    }
}
