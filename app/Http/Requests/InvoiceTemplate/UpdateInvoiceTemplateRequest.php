<?php

namespace App\Http\Requests\InvoiceTemplate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceTemplateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company_name' => ['sometimes', 'string'],
			'company_address' => ['sometimes'],
			'phone' => ['sometimes', 'string'],
			'fax' => ['sometimes', 'string'],
			'npwp' => ['sometimes', 'string'],
			'additional_section' => ['sometimes'],
			'manager_name' => ['sometimes', 'string'],
			'note' => ['sometimes'],
        ];
    }
}
