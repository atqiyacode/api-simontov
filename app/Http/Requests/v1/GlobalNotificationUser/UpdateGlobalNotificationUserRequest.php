<?php

namespace App\Http\Requests\v1\GlobalNotificationUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGlobalNotificationUserRequest extends FormRequest
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
            'global_notification_id' => 'required|exists:global_notifications,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
