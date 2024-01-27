<?php

namespace App\Http\Requests\AlertNotificationType;

use Illuminate\Foundation\Http\FormRequest;

class CreateAlertNotificationTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'job_event' => ['required', 'string'],
            'description' => ['nullable'],
        ];
    }
}
