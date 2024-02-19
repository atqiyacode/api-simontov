<?php

namespace App\Http\Requests\InvoiceTemplate;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceTemplateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string'],
			'company_address' => ['required'],
			'phone' => ['nullable', 'string'],
			'fax' => ['nullable', 'string'],
			'npwp' => ['nullable', 'string'],
			'additional_section' => ['nullable'],
			'manager_name' => ['required', 'string'],
			'note' => ['required'],
        ];
    }
}
