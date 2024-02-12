<?php

namespace App\Http\Requests\InvoiceTemplate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceTemplateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:100'],
            'company_address' => ['required', 'max:1000'],
            'phone' => ['required', 'string', 'max:10'],
            'fax' => ['required', 'string', 'max:10'],
            'npwp' => ['required', 'string', 'max:10'],
            'additional_section' => ['nullable', 'max:1000'],
            'manager_name' => ['required', 'string', 'max:100'],
            'note' => ['nullable', 'max:1000'],
        ];
    }
}
