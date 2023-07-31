<?php

namespace App\Http\Requests\v1\StatusAlarm;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusAlarmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:30|min:3|unique:status_alarms,name,' . $this->statusAlarm->id
        ];
    }
}
