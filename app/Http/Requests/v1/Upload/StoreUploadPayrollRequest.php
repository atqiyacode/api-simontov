<?php

namespace App\Http\Requests\v1\Upload;

use Illuminate\Foundation\Http\FormRequest;

class StoreUploadPayrollRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'files' => 'required|file',
        ];
    }
}
