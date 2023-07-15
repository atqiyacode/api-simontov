<?php

namespace App\Http\Requests\v1\MobileAppMenu;

use Illuminate\Foundation\Http\FormRequest;

class StoreMobileAppMenuRequest extends FormRequest
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
            'code' => 'required|unique:mobile_app_menus,code',
            'name' => 'required|string|max:20',
            'name_en' => 'required|string|max:20',
            'description' => 'required|string|max:200',
            'description_en' => 'required|string|max:200',
            'icon' => 'required|file',
            'status' => 'required|exists:mobile_statuses,id',
        ];
    }
}
