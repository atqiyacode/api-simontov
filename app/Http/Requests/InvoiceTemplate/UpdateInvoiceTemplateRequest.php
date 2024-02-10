<?php

namespace App\Http\Requests\InvoiceTemplate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceTemplateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string'],
            'company_address' => ['required'],
            'phone' => ['required', 'string'],
            'fax' => ['required', 'string'],
            'npwp' => ['required', 'string'],
            'additional_section' => ['nullable'],
            'manager_name' => ['required', 'string'],
            'note' => ['nullbale'],
        ];
    }
}
