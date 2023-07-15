<?php

namespace App\Http\Requests\v1\PersonalNotification;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonalNotificationRequest extends FormRequest
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
            'label' => 'required|string|max:100',
            'message' => 'required|string',
        ];
    }
}
