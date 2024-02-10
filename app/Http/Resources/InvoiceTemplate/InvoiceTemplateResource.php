<?php

namespace App\Http\Resources\InvoiceTemplate;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceTemplateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'company_name' => $this->company_name,
			'company_address' => $this->company_address,
			'phone' => $this->phone,
			'fax' => $this->fax,
			'npwp' => $this->npwp,
			'additional_section' => $this->additional_section,
			'manager_name' => $this->manager_name,
			'note' => $this->note,
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
        ];
    }
}
