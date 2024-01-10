<?php

namespace App\Http\Requests\StatusAlarm;

use Illuminate\Foundation\Http\FormRequest;

class CreateStatusAlarmRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:status_alarms,name'],
        ];
    }
}
