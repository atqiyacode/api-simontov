<?php

namespace App\Http\Requests\v1\NotificationType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationTypeRequest extends FormRequest
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
            'name' => 'required|max:100|unique:notification_types,name,' . $this->notificationType->id,
            'status' => 'required|boolean',
            'description' => 'nullable|string|max:500',
        ];
    }
}
