<?php

namespace App\Http\Requests\v1\GlobalNotification;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGlobalNotificationRequest extends FormRequest
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
            'type' => 'required|exists:notification_types,id',
            'label' => 'required|string|max:100',
            'message' => 'required|string',
        ];
    }
}
