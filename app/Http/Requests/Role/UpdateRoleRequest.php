<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:roles,name,' . $this->id],
            'guard_name' => ['sometimes', 'string'],
        ];
    }
}
