<?php

namespace App\Http\Requests\LocationNotification;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationNotificationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'location_id' => ['required', 'exists:locations,id'],
            'alert_notification_type_id' => ['required', 'exists:alert_notification_types,id'],
        ];
    }
}
