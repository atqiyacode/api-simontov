<?php

namespace App\Http\Requests\StatusAlarm;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusAlarmRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'unique:status_alarms,name,' . $this->id],
        ];
    }
}
